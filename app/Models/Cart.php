<?php

namespace App\Models;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table= 'carts';
    protected $fillable= ['user_id'];
    public $timestamp='true';

    public function user(){
      return  $this->belongsTo(User::class);
    }

    public function items(){
        return $this->belongsToMany(Item::class,'item_cart')->withPivot('quantity');
    }

}
