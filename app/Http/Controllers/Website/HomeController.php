<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {

        Artisan::call('translations:import');
        $products = Product::latest()->take(6)->get();

        return view('website.pages.home', compact('products'));
    }
}
