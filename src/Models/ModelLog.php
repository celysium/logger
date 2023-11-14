<?php

namespace Celysium\Logger\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\HybridRelations;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property int $id
 */
class ModelLog extends Model
{
    use HybridRelations;
    protected $connection = 'logger';
    protected $collection = 'model_log';
    protected $fillable = [
        'id',
        'user_id',
        'user_name',
        'service_name',
        'model_id',
        'model_type',
        'type',
        'attributes'
    ];
}
