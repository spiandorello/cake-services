<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Services\UserServices;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly UserServices $userServices,
    ) {}

    public function index(Request $request): JsonResponse
    {
        return $this->jsonResponse(
          content: $this->userServices
              ->list(
                  queryParams: $request->all(),
              ),
        );
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userServices
            ->create(
                userParams: $request->all(),
            );

        return $this->jsonResponse(
            content: $user->toArray(),
            statusCode: Response::HTTP_CREATED,
        );
    }

    public function show(string $id): JsonResponse
    {
        $user = $this->userServices
            ->listOne($id);

        return $this->jsonResponse(
            content: $user->toArray(),
        );
    }

    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        $cake = $this->userServices
            ->edit(
                id: $id,
                userParams: $request->all(),
            );

        return $this->jsonResponse(
            content: $cake->toArray(),
        );
    }

    public function destroy(string $id): JsonResponse
    {
        $this->userServices
            ->delete(id: $id);

        return $this->jsonResponse(
            statusCode: Response::HTTP_NO_CONTENT,
        );
    }
}
