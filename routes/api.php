<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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


// lay danh sach bai viet
Route::get('/posts', [PostController::class, 'index']);
// them bai viet
Route::post('/posts', [PostController::class, 'store']);
// lay thong tin 1 bai viet
Route::get('/posts/{id}', [PostController::class, 'show']);
// cap nhat bai viet
Route::put('/posts/{id}', [PostController::class, 'update']);
// xoa bai viet 
Route::delete('/posts/{id}', [PostController::class, 'destroy']);


// Route api Users
Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', [UserController::class, 'user']);
    Route::get('/logout', [UserController::class, 'logout']);
});
Route::post('/login', [UserController::class, 'login']);
 // Tao nguoi dung
Route::post('/register', [UserController::class, 'register']);

// // Lay thong tin nguoi dung theo ID 
// Route::get('/users/{id}', [UserController::class, 'show']);

// // Cap nhat thong tin nguoi dung    
// Route::put('/users/{id}', [UserController::class, 'update']);

// // Xoa nguoi dung
// Route::delete('/users/{id}', [UserController::class, 'destroy']);

