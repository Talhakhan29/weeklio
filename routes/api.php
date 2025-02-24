<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [LoginController::class, 'check']);
Route::post('/register', [RegisterController::class, 'store']);

Route::controller(TaskController::class)->group(function(){
    Route::post('/store', 'store');
    Route::get('/fetch', 'fetch');
});