<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCakeRequest;
use App\Models\Cake;
use App\Repositories\CakeRepository\CakeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CakeController extends Controller
{
    public function index(CakeRepositoryInterface $cakeRepository)
    {
        return $cakeRepository->all();
    }

    public function store(StoreCakeRequest $request): Response
    {
        $validated = $request->validated();

//                Cake::create([
//            'name' => 'choclate',
//            'description' => 'choclate',
//            'weight' => 1000,
//            'price' => 20.00,
//            'available_quantity' => 20,
//        ]);
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
