<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait ResponseTrait
{
    public function successResponse($message, $data = [])
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ]);
    }

    public function errorResponse($message, $exception = null, $code = 500)
    {
        if ($exception) {
            Log::error($message . ': ' . $exception->getMessage());
        } else {
            Log::error($message);
        }

        return response()->json([
            'message' => $message
        ], $code);
    }
}
