<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $user = Auth::user();
        if($user){
            $item = Item::find($request->item_id);
            if(!$user->cart){
                $cart = Cart::create(['user_id' => $user->id]);
            }
            else{
                $cart = $user->cart;
            }
            // Check if the item is already in the cart; if so, update the quantity.
            //  cart already contains the specified item
            if ($cart->items->contains($item)) {
                // This retrieves the pivot table row associated with the specific item in the cart. In a many-to-many relationship, the pivot table is used to store additional information about the relationship (in this case, the quantity 
                $pivotRow = $cart->items()->where('item_id', $item->id)->first()->pivot;
                $pivotRow->update(['quantity' => $pivotRow->quantity + $request->quantity]);
            } else {
                // Otherwise, attach the item to the cart(item_cart table).
                $cart->items()->attach($item, ['quantity' => $request->quantity]);
            }
            return redirect()->route('menu');
        }else{
               return redirect(route('login'));
            }
    }

    public function calculateTotalPrice($cart){
        // $cart it the user cart
        $total_price= 0;
        foreach($cart->items as $item){
            $item_price = $item->price * $item->pivot->quantity;
            $total_price += $item_price;
        }
        return $total_price;
    }
    
    public function show(){
        $user = auth()->user();
        if (!$user) {
            // Redirect or handle the case where the user is not authenticated
            return redirect()->route('login');
        }
        //get cart of the user using cart relation to use it in the view 
        $cart = $user->cart;
        if($cart){
            $total_price = $this->calculateTotalPrice($cart);
        }
        // else{
        //     $total_price = 0;

        // }        
        return view('cart.showCart',compact('cart', 'total_price'));
    }

    public function updateQuantity(Request $request, Item $item){
        $user = Auth::user();
        $cart = $user->cart;
        $pivotRow = $cart->items()->where('item_id', $item->id)->first()->pivot;
        $pivotRow->update(['quantity' =>$request->quantity]);
        return back();
    }

    public function delete(Item $item){
        $user = auth()->user();
        $cart = $user->cart;
        if($cart){
            $cart->items()->detach($item->id);
        }
        return back(); 
    }
}
