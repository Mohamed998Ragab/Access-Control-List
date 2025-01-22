<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Resource not found.'], 404);
        }

        if ($exception instanceof ValidationException) {
            return response()->json(['message' => 'Validation failed.', 'errors' => $exception->errors()], 422);
        }

        return response()->json(['message' => 'Something went wrong.'], 500);
    }
}
