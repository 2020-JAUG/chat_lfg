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
Route::get('logout', [PassportAuthController::class, 'logout']);


//AQUI INDICAMOS LAS RUTAS QUE REQUIEREN DE AUTHENTICATE, PARA REALIZAR EL CRUD
Route::middleware('auth:api')->group(function() {

    //CRUD DEL USER
    Route::resource('users', UserController::class);
    // Route::resource('users/all', UserController::class);
    Route::put('users/edit/{id}', [UserController::class, 'update']);


    //CRUD DEL POSTS
    Route::resource('posts', PostController::class);


    //CRUD DEL PARTIES
    Route::resource('parties', PartyController::class);


    //CRUD DEL GAME
    Route::resource('games', GameController::class);

    Route::put('games/edit/{id}', [GameController::class, 'update']);
    Route::get('games/getGameById{id}', [GameController::class, 'getGameById']);

    Route::post('games/title', [GameController::class, 'title']);
    Route::get('games/all', [GameController::class, 'allGames']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
