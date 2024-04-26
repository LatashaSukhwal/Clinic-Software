<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//list show in json format
Route::get('/list/client',[ClientController::class,'ajax_index']);

//list created in json format
Route::get('/create/client',[ClientController::class,"ajax_create"]);
Route::post('/create/client',[App\Http\Controllers\ClientController::class,"ajax_store"]);

//by default middleware
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// edit, delete, update in json format
Route::get('/edit/client/{id}',[App\Http\Controllers\ClientController::class,"edit"]);
Route::put('/update/client/{id}',[App\Http\Controllers\ClientController::class,"ajax_update"]);
Route::delete('/delete/client/{id}',[App\Http\Controllers\ClientController::class,"ajax_delete"]);

//signin 
Route::post('/sigin',[AuthController::class,"siginAPI"]);