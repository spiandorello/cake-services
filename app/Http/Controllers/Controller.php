<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Cake services api",
 *      description="Api to subscribe in your favorite's cake.",
 *      @OA\Contact(
 *          email="eduardo.spiandorello@gmail.com"
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function jsonResponse(
        $content = [],
        int $statusCode = JsonResponse::HTTP_OK
    ): JsonResponse {
        return response()->json($content, $statusCode);
    }
}
