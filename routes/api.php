<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{CakeController};

Route::resource(name: 'cakes', controller: CakeController::class);