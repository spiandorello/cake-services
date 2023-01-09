<?php

use App\Http\Controllers\CakeController;
use App\Http\Controllers\CakeSubscriberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource(name: 'users', controller: UserController::class);
Route::resource(name: 'cakes', controller: CakeController::class);

Route::post(uri: 'cakes-subscriber/{userId}/{cakeId}', action: [CakeSubscriberController::class, 'subscribe']);
Route::delete(uri: 'cakes-subscriber/{userId}/{cakeId}', action: [CakeSubscriberController::class, 'unsubscribe']);
