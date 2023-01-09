<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCakeRequest;
use App\Http\Requests\UpdateCakeRequest;
use App\Services\CakeServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CakeController extends Controller
{
    public function __construct(
        private readonly CakeServices $cakeServices,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->jsonResponse(
            content: $this->cakeServices->list(
                queryParams: $request->query(),
            ),
        );
    }

    public function show(string $id): JsonResponse
    {
        $cake = $this->cakeServices->listOne($id);

        return $this->jsonResponse(
            content: $cake->toArray(),
        );
    }

    public function store(StoreCakeRequest $request): JsonResponse
    {
        $cake = $this->cakeServices
            ->create($request->all());

        return $this->jsonResponse(
            content: $cake->toArray(),
            statusCode: Response::HTTP_CREATED,
        );
    }

    public function update(UpdateCakeRequest $request, string $id): JsonResponse
    {
        $cake = $this->cakeServices
            ->edit(
                id: $id,
                cakeParams: $request->all(),
            );

        return $this->jsonResponse(
            content: $cake->toArray(),
        );
    }

    public function destroy(string $id): JsonResponse
    {
        $this->cakeServices
            ->delete(id: $id);

        return $this->jsonResponse(
            statusCode: Response::HTTP_NO_CONTENT,
        );
    }
}
