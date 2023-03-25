<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //basic view
    public function index(Request $request)
    {
        // return auth()->user()->type;
        return view('shop.home');
    }
}
