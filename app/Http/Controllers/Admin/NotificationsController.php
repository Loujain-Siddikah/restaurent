<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $notifications = $user->notifications;
        // The map function iterates over each item in the collection and applies a callback function to transform each item.
        $transformedNotifications = $notifications->map(function ($notification) {
            //'created_at' is a property on the notification model
            $createdAt = Carbon::parse($notification->created_at);
            // calculates the difference in days, hours, and weeks between the created_at date and the current date.
            $differenceInDays = $createdAt->diffInDays(now());
            $differenceInHours = $createdAt->diffInHours(now());
            $differenceInWeeks = $createdAt->diffInWeeks(now());
            // If the difference in weeks is greater than 2, it formats the date as 'Y-m-d H:i:s'.
            if ($differenceInWeeks > 2) {
                $formattedDate = $createdAt->format('Y-m-d H:i:s');
            } 
            // If the difference in days is greater than 1, it formats the date as 'X days ago'.
            elseif ($differenceInDays > 1) {
                $formattedDate = $differenceInDays . ' days';
            } 
            // If the difference in hours is greater than 0, it formats the date as 'X hours ago'.
            elseif ($differenceInHours > 0) {
                $formattedDate = $differenceInHours . ' hours';
            }else {
                $formattedDate = 'Bir saatten az bir süre önce';
            }
                // Add the formatted date to the notification data
            $notification->formattedDate = $formattedDate;
            return $notification;
        });
        $adminRole = Role::where('name', 'admin')->first();
        $adminUsers = User::role($adminRole)->get();       
        return view('admin.notifications',compact('transformedNotifications','adminUsers'));
    }

    public function orderDetailsNotification(Order $order,$notificationId){
        // Eager load the items along with their quantities
       $orderDetails = Order::with(['user','items','address'])->find($order->id);
       $delivery_fee = 50;
       $notification = auth()->user()->notifications->find($notificationId);
       if ($notification) {
           $notification->markAsRead();
       }
       return view('admin.orderDetails', compact('orderDetails', 'delivery_fee'));
   }
}
