<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
 // Lay danh sach nguoi dung
Route::get('/users', [UserController::class, 'index']);

// Tao nguoi dung
Route::post('/users', [UserController::class, 'store']);

// Lay thong tin nguoi dung theo ID 
Route::get('/users/{id}', [UserController::class, 'show']);

// Cap nhat thong tin nguoi dung    
Route::put('/users/{id}', [UserController::class, 'update']);

// Xoa nguoi dung
Route::delete('/users/{id}', [UserController::class, 'destroy']);