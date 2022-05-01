<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private Request $request,
        private string $page = 'front.pages.home.'
    ) {
    }
    public function index()
    {
        if(empty($this->request->user()->db_url))
            return to_route('about');
        $cryptos = $this->request->user()->cryptos;
        return view($this->page . 'index', compact('cryptos'));
    }
    public function about()
    {
        return view($this->page . 'about');
    }
}
