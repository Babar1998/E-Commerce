<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class FrontendController extends Controller
{
    public function index()
    {
        $category = Category::all()->count();
        $product = Product::all()->count();
        $user = User::all()->count();
        $orders = Order::all()->count();
        $completedorder = Order::where('status', '1')->get()->count();
        $pendingorder = Order::where('status', '0')->get()->count();
        return view('Admin.index', compact('category', 'product', 'user', 'orders', 'completedorder', 'pendingorder'));
    }
}
