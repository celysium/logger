<?php

namespace Celysium\Logger\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property int $id
 */
class RequestLog extends Model
{
    use HasFactory;

    protected $connection = 'logger';
    protected $collection = 'request_log';
    protected $fillable = [
        'id',
        'user_id',
        'user_name',
        'service_name',
        'request',
        'response',
        'time'
    ];
}
