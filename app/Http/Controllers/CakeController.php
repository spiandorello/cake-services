<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCakeRequest;
use App\Services\CakeServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CakeController extends Controller
{
    public function __construct(
        private readonly CakeServices $cakeServices,
    ) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json(
            data: $this->cakeServices->list(
                queryParams: $request->query(),
            ),
        );
    }

    public function show(string $id): JsonResponse
    {
        $cake = $this->cakeServices->listOne($id);

        return response()->json($cake);
    }

    public function store(StoreCakeRequest $request): JsonResponse
    {
        $cake = $this->cakeServices
            ->create($request->all());

        return response()->json(
            data: $cake,
            status: Response::HTTP_CREATED
        );
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $cake = $this->cakeServices
            ->edit(
                id: $id,
                cakeParams: $request->all(),
            );

        return response()->json(
            data: $cake,
            status: Response::HTTP_OK,
        );
    }

    public function destroy(string $id): JsonResponse
    {
        $this->cakeServices
            ->delete(id: $id);

        return response()->json();
    }
}
