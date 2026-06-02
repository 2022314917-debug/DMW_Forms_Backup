<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\Exceptions\InvalidSignatureException;  // ← add this
use Throwable;

class Handler extends ExceptionHandler
{
    // ... your existing $dontFlash or other properties ...

    public function register(): void
    {
        // ... any existing $this->reportable(...) calls you already have ...

        // ← paste this block here
        $this->renderable(function (InvalidSignatureException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'This link has expired or is invalid.'], 403);
            }

            return response()->view('errors.link-expired', [], 403);
        });
    }
}