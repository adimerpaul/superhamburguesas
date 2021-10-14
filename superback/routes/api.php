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
    Route::post('/upload5',[\App\Http\Controllers\RubroController::class,'upload5']);

    Route::post('/updateimg',[\App\Http\Controllers\ProductoController::class,'updateimg']);
    Route::resource('/rubro',\App\Http\Controllers\RubroController::class);
    Route::get('/rubroproductos/{rubro}',[\App\Http\Controllers\RubroController::class,'rubroproductos']);
    Route::post('/misproductos',[\App\Http\Controllers\RubroController::class,'misproductos']);
    Route::get('/misproductosrubros/{rubro_id}',[\App\Http\Controllers\RubroController::class,'misproductosrubros']);

    Route::resource('/producto',\App\Http\Controllers\ProductoController::class);
    Route::post('/crearproducto',[\App\Http\Controllers\ProductoController::class,'crearproducto']);

    Route::resource('/grupo',\App\Http\Controllers\GrupoController::class);
    Route::resource('/subproducto',\App\Http\Controllers\SubproductoController::class);
    Route::resource('/ingrediente',\App\Http\Controllers\IngredienteController::class);
    Route::resource('/combo',\App\Http\Controllers\ComboController::class);
    Route::resource('/cliente',\App\Http\Controllers\ClienteController::class);
    Route::resource('/pedido',\App\Http\Controllers\PedidoController::class);
    Route::post('/printpedido/{id}',[\App\Http\Controllers\PedidoController::class,'printpedido']);
    Route::resource('/incluye',\App\Http\Controllers\IncluyeController::class);
    Route::post('/productadd',[\App\Http\Controllers\ProductoController ::class,'productadd']);
    Route::post('/productsub',[\App\Http\Controllers\ProductoController ::class,'productsub']);
    Route::post('/grupo/{id}',[\App\Http\Controllers\ProductoController ::class,'grupo']);
    Route::post('/upincluye',[\App\Http\Controllers\ProductoController ::class,'upincluye']);
    Route::post('/upingrediente',[\App\Http\Controllers\ProductoController ::class,'upingrediente']);
});

