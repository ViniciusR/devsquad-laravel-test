<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Home action.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $products = Product::get();

        return view('home', compact('products'));
    }
}
