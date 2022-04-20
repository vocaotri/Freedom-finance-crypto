<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoController extends Controller
{
    public function __construct(
        private Request $request,
        private string $page = 'front.pages.crypto.'
    ) {
    }
    public function index()
    {
        $cryptos = $this->request->user()->cryptos;
        return view($this->page . 'index', compact('cryptos'));
    }
    public function add()
    {
        if($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'symbol' => 'required|string|max:255',
            ]);
            $this->request->user()->cryptos()->create($this->request->all());
            return redirect()->route('crypto.index');
        }
        return view($this->page . 'add');
    }
    public function edit($id){
        $crypto = $this->request->user()->cryptos()->findOrFail($id);
        if($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'symbol' => 'required|string|max:255',
            ]);
            $this->request->user()->cryptos()->update($this->request->all());
            return redirect()->route('crypto.index');
        }
        return view($this->page . 'edit', compact('crypto'));
    }
    public function delete($id){
        $crypto = $this->request->user()->cryptos()->findOrFail($id);
        $crypto->delete();
        return redirect()->route('crypto.index');
    }
}
