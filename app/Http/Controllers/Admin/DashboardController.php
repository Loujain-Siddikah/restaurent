<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Symfony\Component\Translation\Util\ArrayConverter;

class DashboardController extends Controller
{
    public function get(){
        $totalUsersCount = User::count();
        $newUsersWeeklyCount = User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        // count of orders in months
        $monthlyOrders = Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as total_orders'))
        ->where('orders.order_status','completed')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $ordersMonthlyCount = Order::whereBetween('created_at',[now()->startOfMonth(),now()->endOfMonth()])->count();

        //get the count of each items ordered
        $mealOrders = DB::table('order_item')->select('items.name as item_name', DB::raw('SUM(order_item.quantity) as total_quantity'))
        ->join('items', 'order_item.item_id', '=', 'items.id')
        ->join('orders', 'order_item.order_id', '=', 'orders.id')
        ->where('orders.order_status','completed')
        ->whereBetween('orders.created_at', [now()->startOfMonth(), now()->endOfMonth()])
        ->groupBy('item_name')
        ->get();


        $orderstotalPrice = Order::select('total_price')->where('order_status','completed')->whereBetween('created_at',[now()->startOfMonth(), now()->endOfMonth()])->get();

        $totalRevenue = $orderstotalPrice->sum('total_price');
        $totalMeals = Item::count();
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::role($adminRole)->first();
        return view('admin.dashboard',compact('totalUsersCount','monthlyOrders','mealOrders','totalRevenue', 'ordersMonthlyCount','newUsersWeeklyCount','totalMeals','adminUser'));
    }


}
