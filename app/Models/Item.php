<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class Item extends Model
{
    use HasFactory;
    protected $table='items';
    protected $fillable = ['name','description','price','section_id','img1','img2','img3'];
    public $timestamp='true';

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function carts(){
        return $this -> belongsToMany(Cart::class,'item_cart')->withPivot('quantity');
    }

    public function orders(){
        return $this -> belongsToMany(Order::class,'order_item')->withPivot('quantity');
    }
}
