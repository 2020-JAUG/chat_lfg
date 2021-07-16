<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//AQUI IMPORTAMOS LOS ARCHIVOS PARA PODER USAR SUS FUNCIONES PARA EL CRUD
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\UserController;

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

//RUTAS VISIBLES SIN AUTH-PARA LOS NUEVOS REGISTROS
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

//AQUI INDICAMOS LAS RUTAS QUE REQUIEREN DE AUTHENTICATE, PARA REALIZAR EL CRUD
Route::middleware('auth:api')->group(function() {
    Route::resource('users', UserController::class);
    Route::resource('users/all', UserController::class);


    Route::resource('posts', PostController::class);
    Route::resource('parties', PartyController::class);
    Route::resource('games', GameController::class);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
