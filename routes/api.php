<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationsController;
use App\Http\Controllers\authController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/donation', [DonationsController::class, 'index']);
Route::post('/donation/add', [DonationsController::class, 'store']);
Route::post('/donation/edit/{id}', [DonationsController::class, 'update']);
Route::delete('/donation/delete/{id}', [DonationsController::class, 'delete']);
Route::get('/donation/{id}', [DonationsController::class, 'getById']);