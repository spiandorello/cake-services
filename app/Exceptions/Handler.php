<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
    ];

    protected $dontReport = [
    ];

    protected $dontFlash = [];

    public function render($request, Throwable $e): JsonResponse
    {
        return \response()->json(
            [
                'message' => $e->getMessage(),
            ],
            $e->getCode() ? $e->getCode() : JsonResponse::HTTP_BAD_REQUEST,
        );
    }
}
