<?php

namespace Celysium\Logger\Middlewares;

use Celysium\Authenticate\Facades\Authenticate;
use Celysium\Logger\Models\RequestLog;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LogRequest
{
    public function handle(Request $request, Closure $next)
    {
        $fire_at = microtime(true);

        $transactionId = Str::uuid()->toString();
        $request->headers->set('transaction_id', $transactionId);

        /** @var Response $response */
        $response = $next($request);
        if ($response instanceof JsonResponse) {
            /** @var RequestLog $requestLog */
            $requestLog = RequestLog::query()->create([
                'user_id'        => Authenticate::id(),
                'user_name'      => Authenticate::name(),
                'service_name'   => env('APP_SLUG'),
                'transaction_id' => $transactionId,
                'name'           => $request->route()->getName(),
                'request'        => [
                    'method' => $request->getMethod(),
                    'uri'    => $request->getRequestUri(),
                    'header' => $request->headers->all(),
                    'body'   => $request->all(),
                ],
                'response'       => [
                    'header' => $response->headers->all(),
                    'body'   => $response->getContent(),
                    'status' => $response->getStatusCode(),
                    'time'   => number_format(microtime(true) - $fire_at, 3),
                ]
            ]);
        }
        return $response;
    }
}
