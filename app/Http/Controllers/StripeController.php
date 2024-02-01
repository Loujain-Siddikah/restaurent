<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;


class StripeController extends Controller
{
    public function showCheckout(){
        Stripe::setApiKey(config('services.stripe.secret_key'));
        // \Stripe\Stripe::setApiKey(env()$stripeSecretKey);
        $user_cart = Auth::user()->cart; 
        foreach($user_cart->items as $cart_item){
            $lineItems[]=[
                'price_data' => [
                    'currency' => 'try',
                    'product_data' => [
                        'name' => $cart_item->description,
                    ],
                    'unit_amount' => $cart_item->price * 100, // Amount in cents
                ],
                    'quantity' =>  $cart_item ->pivot-> quantity,
            ];
        }
        // return $lineItems;


        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);
        
        return redirect($session->url);
    }

    public function payment(){
        Stripe::setApiKey(config('services.stripe.secret_key'));
        // \Stripe\Stripe::setApiKey(env()$stripeSecretKey);
        $user_cart = Auth::user()->cart; 
        foreach($user_cart->items as $cart_item){
            $lineItems[]=[
                'price_data' => [
                    'currency' => 'try',
                    'product_data' => [
                        'name' => $cart_item->description,
                    ],
                    'unit_amount' => $cart_item->price * 100, // Amount in cents
                ],
                    'quantity' =>  $cart_item ->pivot-> quantity,
            ];
        }
        // return $lineItems;


        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);
        
        return redirect($session->url);
    }
}
