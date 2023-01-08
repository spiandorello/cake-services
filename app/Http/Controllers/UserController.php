<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCakeRequest;
use App\Models\Cake;
use App\Models\User;
use App\Repositories\CakeRepository\CakeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        User::create([
            'name' => 'dudu',
            'email'=> 'dudu@mailinator.com',
        ]);
    }

    public function store(): Response
    {
    }

    public function show($id): Response
    {
    }

    public function edit($id): Response
    {
    }

    public function update(Request $request, $id): Response
    {
    }

    public function destroy($id): Response
    {
    }
}
