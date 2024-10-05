<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', '1')->count();
        $pendingOrders = Order::where('status', '0')->count();
        return view('admin.index', compact('totalCategories', 'totalProducts', 'totalUsers', 'totalOrders', 'completedOrders', 'pendingOrders'));
    }

    
}
