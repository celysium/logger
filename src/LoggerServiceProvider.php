<?php

namespace Celysium\Logger;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class LoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $models = $this->models();

    }


    public function models()
    {
        $app_path = app_path();
        $real_path = realpath($app_path) . DIRECTORY_SEPARATOR;
        $namespace = app()->getNamespace();

        return collect((new Finder)->in($app_path)->files()->name('*.php'))
            ->map(function (SplFileInfo $model) use ($real_path, $namespace) {
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
