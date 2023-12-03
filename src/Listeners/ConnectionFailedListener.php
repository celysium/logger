<?php

namespace Celysium\Logger\Listeners;


use Celysium\Authenticate\Facades\Authenticate;
use Celysium\Logger\Models\RequestLog;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Client\Events\ConnectionFailed;

class ConnectionFailedListener
{
    public function __construct()
    {

    }

    public function handle(ConnectionFailed $event): void
    {
        if($name = current($event->request->header('REQUEST-LOG-NAME'))) {
            RequestLog::query()
                ->create([
                    'user_id'        => Authenticate::id(),
                    'user_name'      => Authenticate::name(),
                    'service_name'   => env('APP_SLUG'),
                    'transaction_id' => current($event->request->header('transaction_id')),
                    'name'           => $name,
                    'request'        => [
                        'method' => $event->request->method(),
                        'uri'    => $event->request->url(),
                        'header' => $event->request->headers(),
                        'body'   => json_decode($event->request->body()) ?: [],
                    ],
                    'response'       => [
                        'header' => "",
                        'body'   => "",
                        'status' => Response::HTTP_REQUEST_TIMEOUT,
                        'time'   => number_format(microtime(true) - current($event->request->header('REQUEST-STARTED')), 3),
                    ]
                ]);
        }
    }
}
