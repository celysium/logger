<?php

namespace Celysium\Logger\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property int $id
 */
class ModelLog extends Model
{
    use HasFactory;

    protected $connection = 'model_log';

    protected $fillable = [
        'id',
        'user_id',
        'user_name',
        'request',
        'response',
        'data'
    ];
}
