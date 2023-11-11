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

    protected $connection = 'request_log';

    protected $fillable = [
        'id',
        'user_id',
        'user_name',
        'request',
        'response',
        'type',
        'time'
    ];
}
