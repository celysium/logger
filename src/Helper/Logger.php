<?php

namespace Celysium\Logger\Helper;

use Celysium\Authenticate\Facades\Authenticate;
use Celysium\Logger\Models\ModelLog;
use Illuminate\Database\Eloquent\Model;

class Logger
{
    public static function ModelLog(Model $model, string $type): void
    {
        ModelLog::query()->create([
            'user_id'      => Authenticate::id(),
            'user_name'    => Authenticate::name(),
            'service_name' => env('APP_NAME'),
            'model_id'     => (string)$model->getKey(),
            'model_type'   => $model->getTable(),
            'type'         => $type,
            'attributes'   => $model->toArray()
        ]);
    }
}