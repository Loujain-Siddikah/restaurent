<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Section;
use App\Models\section_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class menuController extends Controller
{
    public function index(){
        $items= Item::all();
        $sections= Section::with('items')->get();
        $section_items=section_item::all();
        return view('menu',compact('items','sections','section_items'));
    }   
}

