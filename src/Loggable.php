<?php

namespace Celysium\Logger;

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
}
