<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function messagesSuccess(mixed $data, string $messages = "ok success", int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'success' => true,
            'messages' => $messages,
        ], $statusCode);
    }

    public function messagesError(string $messages, int $statusCode= 400):JsonResponse
    {
        return response()->json([
            'data' => null,
            'success' => false,
            'messages' => $messages,
        ], $statusCode);
    }
}
