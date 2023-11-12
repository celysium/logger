<?php

namespace Celysium\Logger;

use Celysium\Logger\Middlewares\LogRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class LoggerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $models = $this->models();

        /** @var Model $model */
        foreach ($models as $model) {
            $model::observe(LogObserve::class);
        }

        /** @var Router $router */
        $router = app('router');
        $router->pushMiddlewareToGroup('api', LogRequest::class);
    }

    public function register(): void
    {
        // Merge default configuration
        $this->mergeConfigFrom(__DIR__ . '/config/database.php', 'database.connections.logger_connection');
    }

    public function models()
    {
        $app_path = app_path();
        $namespace = app()->getNamespace();

        return collect((new Finder)->in($app_path)->files()->name('*.php'))
            ->map(function (SplFileInfo $model) use ($namespace) {

                return $namespace . str_replace(['/', '.php'], ['\\', ''], $model->getRelativePathname());

            })
            ->filter(function ($model) {
                return class_exists($model) && $this->isModel($model);
            })
            ->values();
    }

    protected function isModel(string $model): bool
    {
        $uses = class_parents($model);
        return in_array(Model::class, $uses) && !in_array(Pivot::class, $uses);
    }
}
