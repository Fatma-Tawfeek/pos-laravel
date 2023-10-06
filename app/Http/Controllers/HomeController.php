<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $categories_count = Category::count();
        $products_count = Product::count();
        $orders_count = Order::count();
        $users_count = User::count();

        $sales_data = Order::select(
            DB::raw('ANY_VALUE(YEAR(created_at)) as year'),
            DB::raw('ANY_VALUE(MONTH(created_at)) as month'),
            DB::raw('SUM(total_price) as total_price')

        )->groupBy('month')->get();

        return view('home', compact('categories_count', 'products_count', 'orders_count', 'users_count', 'sales_data'));

    }
}
