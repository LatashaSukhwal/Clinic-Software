<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Sigin Routes
Route::get('/sigin',[AuthController::class,"sigin_View"]);
Route::post('/sigin',[AuthController::class,"sigin"]);
Route::post('/signout',[AuthController::class,"signout"]);
Route::post('usercreate',[UserController::class,"create"]);
Route::get('/', function () {
    return view('welcome');
});
//my-name routes
Route::get('/my-name', function () {
    return view('my-name');
});

// authentication apply in list/client
Route::get('/list/client',[ClientController::class,'index'])->middleware('authcheck');
// Route::get('/list/client',[ClientController::class,'index']);

// edit,delete,update,create  in information
Route::get('/create/client',[ClientController::class,"create"]);
Route::post('/create/client',[ClientController::class,"store"]);

Route::get('/edit/client/{id}',[ClientController::class,"edit"]);
Route::put('/update/client/{id}',[ClientController::class,"update"]);
Route::delete('/delete/client/{id}',[ClientController::class,"delete"]);
Route::get('user/create',[UserController::class,"user_create"]);
