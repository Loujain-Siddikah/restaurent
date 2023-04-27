<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\menuController;
use App\Http\Controllers\adminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[menuController::class, 'index']);

// Route::get('/menu',[menuController::class, 'index']);
Route::get('/admin',[adminController::class, 'index'])->middleware('auth');
Route::post('/update_price',[adminController::class,'update']);

// Auth::routes();
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();
});
