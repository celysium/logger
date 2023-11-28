<?php

namespace Celysium\Logger;

use Celysium\Logger\Listeners\ConnectionFailedListener;
use Celysium\Logger\Listeners\ResponseReceivedListener;
use Celysium\Logger\Middlewares\LogRequest;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class LoggerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/database.php', 'database.connections');

        /** @var Router $router */
        $router = app('router');
        $router->pushMiddlewareToGroup('api', LogRequest::class);


        Http::macro('loggable', function (string $name) {
            return Http::withHeaders(['REQUEST-LOG-NAME' => $name, 'REQUEST-STARTED' => microtime(true)]);
        });

        Event::listen('Illuminate\Http\Client\Events\ResponseReceived', ResponseReceivedListener::class);
        Event::listen('Illuminate\Http\Client\Events\ConnectionFailed', ConnectionFailedListener::class);

    }
}
