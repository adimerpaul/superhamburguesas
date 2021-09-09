<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('login',[\App\Http\Controllers\UserController::class,'login']);
Route::post('register',[\App\Http\Controllers\UserController::class,'register']);
Route::resource('/agencia',\App\Http\Controllers\AgenciaController::class);

Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout']);
    Route::post('/me',[\App\Http\Controllers\UserController::class,'me']);
    Route::post('/upload',[\App\Http\Controllers\RubroController::class,'upload']);
    Route::post('/updateimg',[\App\Http\Controllers\ProductoController::class,'updateimg']);
    Route::resource('/rubro',\App\Http\Controllers\RubroController::class);
    Route::resource('/producto',\App\Http\Controllers\ProductoController::class);
    Route::resource('/grupo',\App\Http\Controllers\GrupoController::class);
    Route::resource('/ingrediente',\App\Http\Controllers\IngredienteController::class);
    Route::post('/productadd',[\App\Http\Controllers\ProductoController ::class,'productadd']);
    Route::post('/productsub',[\App\Http\Controllers\ProductoController ::class,'productsub']);
    Route::post('/grupo/{id}',[\App\Http\Controllers\ProductoController ::class,'grupo']);
    Route::post('/upincluye',[\App\Http\Controllers\ProductoController ::class,'upincluye']);
    Route::post('/upingrediente',[\App\Http\Controllers\ProductoController ::class,'upingrediente']);
});

