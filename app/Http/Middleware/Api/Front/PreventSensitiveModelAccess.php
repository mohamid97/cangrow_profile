<?php

namespace App\Http\Middleware\Api\Front;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventSensitiveModelAccess
{
    use ResponseTrait;

    private const BLOCKED_MODELS = ['user', 'users'];

    public function handle(Request $request, Closure $next): Response
    {
        $model = $request->input('model');

        if (is_string($model) && in_array(strtolower(trim($model)), self::BLOCKED_MODELS, true)) {
            return $this->error('This model is not available through public data endpoints.', 403);
        }

        return $next($request);
    }
}
