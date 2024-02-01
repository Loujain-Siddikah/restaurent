<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table= 'orders';
    protected $fillable= ['user_id', 'total_price','order_status', 'payment_status', 'address_id', 'paymentIntent_id', 'order_number'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function items(){
        return $this->belongsToMany(Item::class,'order_item')->withPivot('quantity');
    }
}
