<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function get(){
    // Get the "customer" role
        $customerRole = Role::where('name', 'customer')->first();

        $customers = User::role($customerRole->name)->withSum(['orders as completed_total_price' => function($query){
            $query->where('order_status','completed');
        }], 'total_price')->withCount(['orders as completed_orders_count' => function ($query) {
            $query->where('order_status', 'completed');
        }])->get();
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::role($adminRole)->first(); 
    return view('admin.customers', compact('customers','adminUser'));
    }

    public function add(CustomerRequest $request){
        $customer = User::create([
            'first_name' => $request->first_name,
            'last_name' =>  $request->last_name,
            'email' =>  $request->email,
            'password' => Hash::make( $request->password),
        ]);
        $customer -> assignRole('customer');
        return redirect()->back();
    }

    public function customerDetails(User $customer){
        $customer = User::with(['addresses','orders'])->where('id',$customer->id)->first();
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::role($adminRole)->first();
        return view('admin.customerDetails', compact('customer','adminUser'));
    }
    
}
