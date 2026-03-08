<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//1
Route::get('/equipment', [EquipmentController::class,'index']);

//2
Route::get('/equipment/{id}', [EquipmentController::class,'show']);

//3
Route::get('/equipment/{id}/popularity', [EquipmentController::class,'showPopularity']);

//4
Route::post('/user', [UserController::class,'store']);

//5
Route::post('/user/{id}', [UserController::class,'update']);

//6
Route::delete('/review/{id}',[ReviewController::class,'destroy']);

//7
Route::get('/equipment/{id}/average-total-cost', [EquipmentController::class,'showAverageTotalCost']);