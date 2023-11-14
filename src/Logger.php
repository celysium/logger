<?php

namespace Celysium\Logger;

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
            'model_id'     => $model->getKey(),
            'model_type'   => $model->getMorphClass(),
            'type'         => $type,
            'attributes'   => $model->toArray()
        ]);
    }
}