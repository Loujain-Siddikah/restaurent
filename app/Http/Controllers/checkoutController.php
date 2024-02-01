<?php

namespace App\Http\Controllers;

use Log;
use Stripe\Token;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Order;
use Stripe\PaymentIntent;
use App\Events\MealOrdered;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\CartController;
use App\Notifications\NewOrder;

class checkoutController extends Controller
{
    public function showCheckout(){
        $user = Auth::user();
        $user_addresses= $user->addresses;
        $delivery_fee = 50;
        $cartController = new CartController();
        $subTotal = $cartController->calculateTotalPrice($user->cart);
        $total_price = $subTotal + $delivery_fee;
        return view('checkout', compact('user', 'delivery_fee','total_price', 'subTotal','user_addresses'));
    }

    public function success(){
        return view('successPay');
    }

    public function placeOrder(Request $request){
        $user = Auth::user();
        $cart = $user->cart;
        $delivery_fee = 50;
        $cartController = new CartController();
        $subTotal = $cartController->calculateTotalPrice($cart);
        $total_price = $subTotal + $delivery_fee;
        if ($request->input('payment_method') === 'pay_when_delivery') {
            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $request->address,
                'total_price' => $total_price,
                'payment_status' => $request->payment_method,
                'order_number' => $this->generateOrderNumber(),
            ]);
            // Add items from the user's cart to the order
            foreach($cart->items as $item){
                $order->items()->attach($item->id, ['quantity' => $item->pivot->quantity]);
            }
            $cart->items()->detach();
            $adminRole = Role::where('name', 'admin')->first();
            $adminUsers = User::role($adminRole)->get();
            foreach ($adminUsers as $adminUser) {
                $adminUser->notify(new NewOrder($order->load('user')));
            }
            return redirect('/success');
        // If payment is through Stripe with paymentIntent
        }elseif ($request->input('payment_method') === 'stripe') {
            try {
                Stripe::setApiKey(config('services.stripe.secret_key'));
                $stripe_payment_method = $request->input('stripe_payment_method');
                $paymentIntent = PaymentIntent::create([
                    'amount' => $total_price * 100, // Convert to cents
                    'currency' => 'try',
                    'payment_method' =>  $stripe_payment_method, // Use the paymentMethod token
                    'confirmation_method' => 'automatic', // Adjust as needed
                    'confirm' => true,
                    'return_url' => route('success'), // Set your success page URL
                ]);
                if ($paymentIntent->status === 'succeeded') {
                    $order = Order::create([
                        'user_id' => $user->id,
                        'address_id' => $request->address,
                        'total_price' => $total_price,
                        'payment_status' => 'paid',
                        'paymentIntent_id' => $paymentIntent->id,
                        'order_number' => $this->generateOrderNumber(),
                    ]);
                        // Add items from the user's cart to the order
                    foreach($cart->items as $item){
                        $order->items()->attach($item->id, ['quantity' => $item->pivot->quantity]);
                    }
                    $cart->items()->detach();
                        // broadcast(new MealOrdered($order));
                    $adminRole = Role::where('name', 'admin')->first();
                    $adminUsers = User::role($adminRole)->get();
                    foreach ($adminUsers as $adminUser) {
                        $adminUser->notify(new NewOrder($order->load('user')));
                    }
                    return redirect('/success');
                }else {
                        // $order->update(['payment_status' => 'failed']);
                    return back()->with('fail','order not placed please try again');
                }    
            } catch (\Stripe\Exception\CardException $e) {
                return back()->with('fail','order not placed please try again');
            }    
        }
    }
    
    function generateOrderNumber(){
    $timestamp = now()->format('YmdHis'); // Current timestamp
    $random = Str::random(5); // Random string, adjust length as needed

    return "{$timestamp}-{$random}";
    }


}


        


