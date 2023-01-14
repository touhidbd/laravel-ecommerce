<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Brands;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Categories::count();
        $totalBrands = Brands::count();

        $totalAllUsers = User::count();
        $totalAdmins = User::where('role_as', '1')->count();
        $totalUsers = User::where('role_as', '0')->count();
        
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', '>=', Carbon::today())->count();
        $thisMonthOrders = Order::whereMonth('created_at', Carbon::now()->format('m'))->count();
        $thisYearOrders = Order::whereYear('created_at', Carbon::now()->format('Y'))->count();

        return view('admin.index', compact('totalProducts', 'totalCategories', 'totalBrands', 'totalAllUsers', 'totalAdmins', 'totalUsers', 'totalOrders', 'todayOrders', 'thisMonthOrders', 'thisYearOrders'));
    }
}
