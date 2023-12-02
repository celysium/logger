<?php

namespace Celysium\Logger\Listeners;

use Celysium\Authenticate\Facades\Authenticate;
use Celysium\Logger\Models\RequestLog;
use Illuminate\Http\Client\Events\ResponseReceived;

class ResponseReceivedListener
{

    public function __construct()
    {
    }


    public function handle(ResponseReceived $event): void
    {

        RequestLog::query()
            ->create([
                'user_id'      => Authenticate::id(),
                'user_name'    => Authenticate::name(),
                'service_name' => env('APP_SLUG'),
                'name'         => current($event->request->header('REQUEST-LOG-NAME')) ?: null,
                'request'      => [
                    'method' => $event->request->method(),
                    'uri'    => $event->request->url(),
                    'header' => $event->request->headers(),
                    'body'   => $event->request->json(),
                ],
                'response'     => [
                    'header' => $event->response->headers(),
                    'body'   => $event->response->json(),
                    'status' => $event->response->status(),
                    'time'   => number_format(microtime(true) - current($event->request->header('REQUEST-STARTED')), 3),
                ]
            ]);

    }
}
