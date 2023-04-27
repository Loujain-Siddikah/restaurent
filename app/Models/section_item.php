<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section_item extends Model
{
    use HasFactory;
    protected $table='section_items';
    protected $fillable = ['description','price','img','section_id'];
    public $timestamp='true';
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
}
