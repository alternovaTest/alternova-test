<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CustomException extends Exception
{
    public function render()
    {
        return response()->json([
            'error_message' => $this->getMessage(),
            'file' => $this->file,
            'line' => $this->line,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
