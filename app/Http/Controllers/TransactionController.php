<?php

namespace App\Http\Controllers;

use App\Enums\Market;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private Transaction $transaction,
        private Request $request,
        private string $page = 'front.pages.transaction.'
    ) {
    }

    public function index($cryptoID = null)
    {
        $cryptos = $this->request->user()->cryptos()->get();
        $transactions = $this->transaction->select('*')->where('user_id', $this->request->user()->id);
        if ($cryptoID) {
            $transactions->where('crypto_id', $cryptoID);
        }
        $transactions = $transactions->paginate(10);
        return view($this->page . 'index', compact('transactions', 'cryptos', 'cryptoID'));
    }

    public function add()
    {
        $cryptos = $this->request->user()->cryptos()->get();
        if ($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'amount' => 'required|numeric',
                'price' => 'required|numeric',
                'market' => 'required|string|in:' . '' . Market::Buy->value . ',' . Market::Sell->value,
            ]);
            $isCompleted = $this->caculateCryptoByTransaction($this->request->crypto_id, $this->request->market, $this->request->amount, $this->request->price);
            if ($isCompleted === 1)
                return redirect()->back()->withErrors(['amount' => 'You can not sell more than you have']);
            if ($isCompleted) {
                $this->request->user()->transactions()->create($this->request->all());
                return redirect()->route('transaction.index');
            }
        }
        return view($this->page . 'add', compact('cryptos'));
    }
    // when transaction is completed can not edit
    public function edit($id)
    {
        $cryptos = $this->request->user()->cryptos()->get();
        $transaction = $this->request->user()->transactions()->findOrFail($id);
        if ($this->request->isMethod('post') && 0 > 1) {
            $this->validate($this->request, [
                'amount' => 'required|numeric',
                'price' => 'required|numeric',
                'market' => 'required|string|in:' . '' . Market::Buy->value . ',' . Market::Sell->value,
            ]);
            $isCompleted = $this->caculateCryptoByTransaction($this->request->crypto_id, $this->request->market, $this->request->amount, $this->request->price);
            if ($isCompleted === 1)
                return redirect()->back()->withErrors(['amount' => 'You can not sell more than you have']);
            if ($isCompleted) {
                $transaction->update($this->request->all());
                return redirect()->route('transaction.index');
            }
        }
        return view($this->page . 'edit', compact('transaction', 'cryptos'));
    }

    public function delete($id)
    {
        $transaction = $this->request->user()->transactions()->findOrFail($id);
        $crypto_id = $transaction->crypto_id;
        $isCompleted = $this->caculateCryptoByTransaction($crypto_id, $transaction->market, $transaction->amount, $transaction->price);
        if ($isCompleted === 1)
            return redirect()->back()->withErrors(['amount' => 'You can not sell more than you have']);
        if ($isCompleted) {
            $transaction->delete();
            return redirect()->route('transaction.index');
        }
    }
    private function caculateCryptoByTransaction($crypto_id, $market, $new_coin, $new_price)
    {
        $cryptoOrigin = $this->request->user()->cryptos()->findOrFail($crypto_id);
        $avgPrice = 0;
        $totalCoin = 0;
        if ($market == Market::Buy->value) {
            $avgPrice = ($cryptoOrigin->total_coin * $cryptoOrigin->avg_price + $new_coin * $new_price) / ($cryptoOrigin->total_coin + $new_coin);
            $totalCoin = $cryptoOrigin->total_coin + $new_coin;
        } else {
            if ($cryptoOrigin->total_coin - $new_coin > 0) {
                $avgPrice = ($cryptoOrigin->total_coin * $cryptoOrigin->avg_price - $new_coin * $new_price) / ($cryptoOrigin->total_coin - $new_coin);
            }
            $totalCoin = $cryptoOrigin->total_coin - $new_coin;
            if ($totalCoin < 0)
                return 1;
        }
        $totalUSDT = $avgPrice * $totalCoin;
        return $cryptoOrigin->update([
            'avg_price' => $avgPrice,
            'total_coin' => $totalCoin,
            'total_usdt' => $totalUSDT,
        ]);
    }
}
