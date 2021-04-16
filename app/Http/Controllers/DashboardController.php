<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\ReturnProduct;

class DashboardController extends Controller
{
    public function index(){
        $total_users = User::count();
        $total_products = Product::count();
        $total_stocks_in = ProductStock::where('status', ProductStock::STOCK_IN)->count();
        $total_return_product = ReturnProduct::count();
        $recent_products = Product::latest()->limit(10)->get();

        return view('dashboard', compact('total_users', 'total_products', 'total_stocks_in', 'total_return_product', 'recent_products'));
    }
}
