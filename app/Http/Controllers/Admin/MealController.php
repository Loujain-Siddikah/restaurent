<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\User;
use App\Models\Section;
use App\Traits\imageTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddMealRequest;
use App\Http\Requests\UpdateMealRequest;

class MealController extends Controller
{
    use imageTrait;
    public function addPage(){
        $sections = Section::get();
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::role($adminRole)->first();
        return view('admin.addMeal', compact('sections','adminUser'));
    }

    public function add(AddMealRequest $request){     
        $newItem = Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'section_id' => $request->section_id,
        ]);
        $i=1;
        foreach($request->file('images') as $index => $image){ 
                $i++;  
                $index++;
                if($i>3){
                    // session()->flash('error', 'You must enter a maximum of 3 images.');
                    return redirect()->back();
                }  
                $image_name=$this->saveImage($image,'images/meals/'); 
                $newItem->img.$index = 'images/meals/' . $image_name;
        }
        return redirect('/');
    }

    public function edit(Item $item){
        $sections = Section::get();
        return view('admin.editMeal',compact('item', 'sections'));
    }

    public function update(Item $item, UpdateMealRequest $request){
        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->section_id = $request->section_id;
        if($request->file('image1')){
            $image_name=$this->saveImage($request->image1,'images/meals/'); 
            $item->update([
                    "img1" =>'images/meals/'.$image_name,
            ]);
        }
        if($request->file('image2')){
            $image_name=$this->saveImage($request->image2,'images/meals/'); 
            $item->update([
                    "img2" =>'images/meals/'.$image_name,
            ]);
        }
        if($request->file('image3')){
            $image_name=$this->saveImage($request->image1,'images/meals/'); 
            $item->update([
                    "img3" =>'images/meals/'.$image_name,
            ]);
        }
        $item->save();
      
        // if($request->file('images')){
        //     $i=1;
        //     foreach($request->file('images') as $index => $image){ 
        //         $i++;  
        //         if($i>3){
        //             // session()->flash('error', 'You must enter a maximum of 3 images.');
        //             return redirect()->back();
        //         }  
        //         $image_name=$this->saveImage($image,'images/meals/'); 
        //         $item->update([
        //             "img" . ($index + 1) =>'images/meals/'.$image_name,
        //         ]);
        //     }
        // }
        
        return redirect()->back();
    }

    public function delete(Item $item){
        $item->delete();
        return redirect()->back();
    }
}
