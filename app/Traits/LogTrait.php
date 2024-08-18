<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    public function logError($message, $exception = null)
    {
        if ($exception) {
            Log::error($message . ': ' . $exception->getMessage());
        } else {
            Log::error($message);
        }
    }
}
