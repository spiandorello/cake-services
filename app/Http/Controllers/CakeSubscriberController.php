<?php

namespace App\Http\Controllers;

use App\Services\CakeSubscriberServices;
use Illuminate\Http\JsonResponse;

class CakeSubscriberController extends Controller
{
    public function __construct(
        private readonly CakeSubscriberServices $cakeSubscriberServices,
    ) {
    }

    public function subscribe(string $userId, string $cakeId): JsonResponse
    {
        $cakeSubscriber = $this->cakeSubscriberServices->subscribe(
            userId: $userId,
            cakeId: $cakeId,
        );

        return $this->jsonResponse(
            content: $cakeSubscriber->toArray(),
            statusCode: JsonResponse::HTTP_CREATED
        );
    }

    public function unsubscribe(string $userId, string $cakeId): JsonResponse
    {
        $this->cakeSubscriberServices->unsubscribe(
            userId: $userId,
            cakeId: $cakeId,
        );

        return $this->jsonResponse();
    }
}
