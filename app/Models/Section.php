<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table='sections';
    protected $fillable = ['name'];
    public $timestamp='true';
    public function items()
    {
        return $this->hasMany('App\Models\section_item');
    }
   

}
