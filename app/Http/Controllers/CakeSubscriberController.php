<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCakeRequest;
use App\Models\Cake;
use App\Models\CakeSubscriber;
use App\Repositories\CakeRepository\CakeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CakeSubscriberController extends Controller
{
    public function index()
    {
        CakeSubscriber::create([
            'user_id' => '982b32e3-4c9b-4094-9c16-6da2476877a3',
            'cake_id' => '982b3053-50f6-401f-94f1-2751ee3563e8',
        ]);
    }
}
