<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{CakeController, UserController, CakeSubscriberController};

Route::resource(name: 'users', controller: UserController::class);
Route::resource(name: 'cakes', controller: CakeController::class);

Route::post(uri: 'cakes-subscriber/{userId}/{cakeId}', action: [CakeSubscriberController::class, 'subscribe']);
Route::delete(uri: 'cakes-subscriber/{userId}/{cakeId}', action: [CakeSubscriberController::class, 'unsubscribe']);
