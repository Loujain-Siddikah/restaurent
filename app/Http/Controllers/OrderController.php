<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showOrders(){
        $user = Auth::user();
        $orders = $user->orders;
        return view('user.orders',compact('orders'));
    }

}
