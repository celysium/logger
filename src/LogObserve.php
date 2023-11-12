<?php

namespace Celysium\Logger;

use Celysium\Authenticate\Facades\Authenticate;
use Celysium\MessageBroker\Events\SendMessageEvent;
use Illuminate\Database\Eloquent\Model;

class LogObserve
{
    const CREATED = 1;
    const UPDATED = 2;
    const DELETED = 3;
    const RESTORED = 4;

    /**
     * Handle the Model "created" event.
     */
    public function created(Model $model): void
    {
        $this->sendEvent($model, self::CREATED);
    }

    /**
     * Handle the Model "updated" event.
     */
    public function updated(Model $model): void
    {
        $this->sendEvent($model, self::UPDATED);
    }

    /**
     * Handle the Model "deleted" event.
     */
    public function deleted(Model $model): void
    {
        $this->sendEvent($model, self::DELETED);
    }

    /**
     * Handle the Model "restored" event.
     */
    public function restored(Model $model): void
    {
        $this->sendEvent($model, self::RESTORED);
    }

    /**
     * Handle the Model "force deleted" event.
     */
    public function forceDeleted(Model $model): void
    {
        $this->deleted($model);
    }


    private function sendEvent(Model $model, int $type): void
    {
//        event(new SendMessageEvent('sendLog',
//            [
//                'user_id'    => Authenticate::id(),
//                'user_name'  => Authenticate::name(),
//                'model_id'   => $model->getKey(),
//                'model_type' => Model::class,
//                'type'       => $type,
//                'attributes' => $model->toArray()
//            ]
//        ));
    }
}
