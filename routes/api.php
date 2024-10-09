<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTHENTIFICATION PREFIX 
Route::prefix('auth')->group(function () {
    // création de compte
    Route::post('/register',[App\Http\Controllers\AuthController::class,"register"]);
    // connexion au compte
    Route::post('/login',[App\Http\Controllers\AuthController::class,"login"]);
    // déconnexion au compte
    Route::delete('/logout',[App\Http\Controllers\AuthController::class,"logout"]);
});

// SECURISATION DES ROUTES AVEC JWT
Route::group(["middleware" => ["auth:api"]], function(){
    // création des posts
    Route::post('/posts',[App\Http\Controllers\PostController::class,"store"]);
    // liste des posts du user connecté
    Route::get('/posts',[App\Http\Controllers\PostController::class,"index"]);
    //detail d’un post du user connecté (à partir de l’id)
    Route::get('/posts/{id}',[App\Http\Controllers\PostController::class,"show"]);
    //detail d’un post du user connecté (à partir du slug)
    Route::get('/posts/{slug}',[App\Http\Controllers\PostController::class,"show_slug"]);
    //mise à jour d’un post du user connecté
    Route::put('/posts/{id}',[App\Http\Controllers\PostController::class,"update"]);
    //supprimer d’un post qui appartient au user connecté
    Route::delete('/posts/{id}',[App\Http\Controllers\PostController::class,"destroy"]);
});