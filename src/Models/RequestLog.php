<?php

namespace Celysium\Logger\Models;

use MongoDB\Laravel\Eloquent\Model;

/**
 * @property int $id
 */
class RequestLog extends Model
{
    protected $connection = 'logger';
    protected $collection = 'request_log';
    protected $fillable = [
        'id',
        'user_id',
        'user_name',
        'transaction_id',
        'service_name',
        'name',
        'request',
        'response',
    ];
}
