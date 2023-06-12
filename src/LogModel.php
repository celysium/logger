<?php

namespace Celysium\Logger;


use Illuminate\Database\Eloquent\Model;

class LogModel
{
    /**
     * Handle the User "created" event.
     */
    public function created(Model $model): void
    {
        //
    }

    /**
     * Handle the Model "updated" event.
     */
    public function updated(Model $model): void
    {
        //
    }

    /**
     * Handle the Model "deleted" event.
     */
    public function deleted(Model $model): void
    {
        //
    }

    /**
     * Handle the Model "restored" event.
     */
    public function restored(Model $model): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $model): void
    {
        //
    }
}
