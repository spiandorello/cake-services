<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{CakeController, UserController, CakeSubscriberController};

Route::resource(name: 'users', controller: UserController::class);
Route::resource(name: 'cakes', controller: CakeController::class);
Route::resource(name: 'cakes-subscriber', controller: CakeSubscriberController::class);