<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Section;
class menuController extends Controller
{
    public function index(){
        $sections= Section::where('status', 'publish')->with('items')->get();
        $addedToCart = false;
        return view('menu',compact('sections','addedToCart'));
    }
    
}

