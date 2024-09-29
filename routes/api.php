<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//animes
Route::apiResource('/animes',App\Http\Controllers\Api\AnimeController::class);


//episodes
Route::apiResource('/episodes',App\Http\Controllers\Api\EpisodeController::class);

//comments
Route::apiResource('/comments',App\Http\Controllers\Api\CommentController::class);

//users
Route::apiResource('/users',App\Http\Controllers\Api\UserController::class);

//user authentication
Route::post('/auth',[UserController::class,'auth']);