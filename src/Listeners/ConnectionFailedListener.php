<?php

namespace Celysium\Logger\Listeners;


use Celysium\Authenticate\Facades\Authenticate;
use Celysium\Logger\Models\RequestLog;
use Symfony\Component\HttpFoundation\Response;

class ConnectionFailedListener
{
    public function __construct()
    {

    }

    public function handle(object $event): void
    {

        RequestLog::query()
            ->create([
                'user_id'      => Authenticate::id(),
                'user_name'    => Authenticate::name(),
                'service_name' => env('APP_SLUG'),
                'name'         => $event->request->header('REQUEST-LOG-NAME'),
                'request'      => [
                    'method' => $event->request->method(),
                    'uri'    => $event->request->url(),
                    'header' => $event->request->headers(),
                    'body'   => $event->request->body(),
                ],
                'response'     => [
                    'header' => "",
                    'body'   => "",
                    'status' => Response::HTTP_REQUEST_TIMEOUT,
                    'time'   => number_format(microtime(true) - $event->request->header('REQUEST-STARTED'), 3),
                ]
            ]);
    }
}
