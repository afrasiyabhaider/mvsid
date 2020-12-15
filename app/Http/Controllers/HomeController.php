<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::count();
        $vendors = Vendor::count();
        $manufacturer = Manufacturer::count();
        $with_images = Product::where('image','!=',NULL)->count();
        $without_images = Product::where('image',NULL)->count();
        return view('dashboard.home',compact('products', 'with_images', 'without_images','vendors','manufacturer'));
        // return view('home');
    }
}
