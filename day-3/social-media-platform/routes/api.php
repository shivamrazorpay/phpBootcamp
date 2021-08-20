<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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

Route::middleware(['auth:sanctum','verified'])->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware(['auth:sanctum', 'verified'])->group(function(){
//    Route::post('/user',[TasksController::class, 'addUser']);
//    Route::get('/user',[TasksController::class, 'getAllUser']);
//    Route::post('/{user}/post',[TasksController::class, 'createPost']);
//    Route::post('/{post}/comment',[TasksController::class, 'createCommentByPostId']);
//    Route::get('/{post}/comment',[TasksController::class, 'getCommentByPostId']);
//});

Route::post('/user',[TasksController::class, 'addUser']);
Route::get('/user',[TasksController::class, 'getAllUser'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);
Route::post('/{user}/post',[TasksController::class, 'createPost'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);
Route::get('/{user}/post',[TasksController::class, 'getAllPostByUserId'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);
Route::post('/{post}/comment',[TasksController::class, 'createCommentByPostId'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);
Route::get('/{post}/comment',[TasksController::class, 'getAllCommentByPostId'])->middleware(\App\Http\Middleware\EnsureTokenIsValid::class);

