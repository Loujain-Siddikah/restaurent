<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use Illuminate\Validation\ValidationException;

class SectionsController extends Controller
{
    public function get(){
        // get count of items in section
        $sections = Section::withCount('items')->get();
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::role($adminRole)->first();       
        return view('admin.sections',compact('sections','adminUser'));
    }

    public function add(SectionRequest $request){
        try{
            Section::create([
                'name' => $request->name,
                'status' => $request->status
            ]);
            return redirect()->back();
        }catch (ValidationException $e) {
        return redirect()->back()->withErrors(['errors' => $e->errors()]);
        }
    }

    public function update(SectionRequest $request){
        try{
            $section = Section::findOrFail($request->section_id);
            $section->name = $request->name;
            $section->status = $request->status;
            $section->save();
            return redirect()->back();
        }catch (ValidationException $e) {
        return redirect()->back()->withErrors(['errors' => $e->errors()]);
        }
    }

    public function delete(Request $request){
        $section = Section::findOrFail($request->section_id);
        $section->delete();
        return redirect()->back();
    }
}

