<?php

namespace Celysium\Logger;

use Celysium\Authenticate\Facades\Authenticate;
use Celysium\Logger\Models\ModelLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Loggable
{
    public function logs(): MorphMany
    {
        /** @var Model $this */
        return $this->morphMany(ModelLog::class, 'model');
    }

    public function log(string $type): void
    {
        /** @var Model $this */
        ModelLog::query()->create([
            'user_id'      => Authenticate::id(),
            'user_name'    => Authenticate::name(),
            'service_name' => env('APP_NAME'),
            'model_id'     => $this->getKey(),
            'model_type'   => get_class($this),
            'type'         => $type,
            'attributes'   => $this->toArray()
        ]);
    }
}
