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
        'service_name',
        'request',
        'response',
    ];
}
