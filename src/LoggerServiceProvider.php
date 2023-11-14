<?php

namespace Celysium\Logger;

use Celysium\Logger\Middlewares\LogRequest;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LoggerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/database.php', 'database.connections');

        /** @var Router $router */
        $router = app('router');
        $router->pushMiddlewareToGroup('api', LogRequest::class);
    }
}
