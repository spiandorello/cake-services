<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCakeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CakeController extends Controller
{
    public function index()
    {
        return [
            'ma oi' => '123'
        ];
    }

    public function store(StoreCakeRequest $request): Response
    {
        $validated = $request->validated();
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
