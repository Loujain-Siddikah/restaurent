<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(ProfileRequest $request){
        try{
            $request-> validated($request->all);
            $user= User::where('id',Auth::user()->id)->first();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            return redirect()->back();
        }catch(ValidationException $e){
            return redirect()->back()->withErrors(['errors' => $e->errors()]);
        }
    }

    public function addresses(){
        $user = Auth::user();
        return view('user.addresses', compact('user'));
    }

    public function addAddress(AddressRequest $request){
        try{
            $request-> validated($request->all);
            $address = Address::create([
                'user_id' => auth()->user()->id,
                'name' => $request -> name,
                'district' => $request -> area,
                'street' => $request -> street,
                'floor' => $request -> floor,
                'details' => $request -> details,
            ]);
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors(['errors' => $e->errors()]);
        }
    }

    public function updateAddress(AddressRequest $request){
        try{
            $validator= $request-> validated($request->all);
            $address= Address::findOrFail($request->address_id);
            $address->name = $request->name;
            $address->district = $request->area;
            $address->street = $request->street;
            $address->floor = $request->floor;
            $address->details = $request->details;
            $address->save();
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors(['errors' => $e->errors()]);
        }
    }

    public function deleteAddress(Request $request){
        try{
            $address= Address::findOrFail($request->address_id);
            $address -> delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete address. Please try again.']);
        }
    }

    // public function getCitiesInBursa()
    // {
    //     $username = config('services.geonames.username');
    // $url = "http://api.geonames.org/searchJSON?q=bursa&country=TR&featureClass=P&username={$username}";

    // $response = Http::get($url);
    // $cities = $response->json()['geonames'];

    // return view('cities.index', compact('cities'));
    // }

}
