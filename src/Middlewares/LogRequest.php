<?php

namespace Celysium\Logger\Middlewares;

use Celysium\Authenticate\Facades\Authenticate;
use Celysium\Logger\Models\RequestLog;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequest
{
    public function __construct()
    {
    }

    public function handle(Request $request, Closure $next): void
    {
        /** @var Response $response */
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $fire_at = microtime(true);

            /** @var RequestLog $requestLog */
            RequestLog::query()->create([
                'user_id'   => Authenticate::id(),
                'user_name' => Authenticate::name(),
                'request'   => [
                    'method' => $request->getMethod(),
                    'uri'    => $request->getRequestUri(),
                    'header' => $request->headers->all(),
                    'body'   => $request->all(),
                ],
                'response'  => [
                    'header' => $response->headers->all(),
                    'body'   => $response->getContent(),
                    'status' => $response->getStatusCode(),
                    'time'   => number_format(microtime(true) - $fire_at, 3),
                ]
            ]);
        }
    }
}