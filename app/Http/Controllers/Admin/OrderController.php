<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orders(){
        $orders = Order::with(['user','address'])->get();
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::role($adminRole)->first(); 
        return view('admin.ordersList',compact('orders','adminUser'));
    }

    public function orderDetails(Order $order){
         // Eager load the items along with their quantities
        $orderDetails = Order::with(['user','items','address'])->find($order->id);
        $delivery_fee = 50;
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::role($adminRole)->first(); 
        return view('admin.orderDetails', compact('orderDetails', 'delivery_fee','adminUser'));
    }
    public function updateStatus(Request $request, Order $order){
        $request->validate([
            'status'=>'required|in:pending,processing,on_delivery,completed'
        ]);
        $order->update(['order_status'=>$request->status]);
        return redirect()->back();
    }
}
