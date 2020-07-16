<?php

namespace App\EloquentModels;

use App\BookmarkIndexConfigurator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

/**
 * Элоквент модель информации по выполненным джобам
 *
 * @property string     $job
 * @property integer    $status
 * @property array      $result
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 */
class JobResult extends Model
{
    const STATUS_PROCESSING = 0;
    const STATUS_DONE = 1;
    const STATUS_ERROR = 2;

    protected $primaryKey = 'job_result_id';

    protected $table = 'job_results';

    protected $fillable = [
        'job',
        'status',
        'result'
    ];

    protected $casts = [
        'result' => 'array'
    ];
}
