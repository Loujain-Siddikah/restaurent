<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Section;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(){
        $items= Item::all();
        $sections= Section::with('items')->get();
        // $section_items=SectionItem::all();
        $no_section_items=Item::where('section_id',null)->get();
        return view('admin',compact('items','sections'));
    }

    public function update(Request $request)  {
        $updated_prices= $request->item_price;
        foreach( $updated_prices as $item_id => $item_price){
            $item= Item::find($item_id);
            $item->price = $item_price;
            $item->update();
        }
        $updated_item_prices= $request->section_item_price;
        foreach( $updated_item_prices as $section_item_id => $section_item_price){
            // $section_item= SectionItem::find($section_item_id);
            // $section_item->price = $section_item_price;
            // $section_item->update();
        }
        // if ($section_item  && $item){
            return back()->with('success','Fiyatlar başarı ile güncellendi');
        // }else{
            // return back()->with('fail','Güncelleme başarısız oldu');
        }
    }
// }
