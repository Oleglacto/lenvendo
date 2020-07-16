<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\EloquentModels\JobResult;
use App\Jobs\MakeReport;

class ReportsController
{
    public function make()
    {
        MakeReport::dispatch()->onQueue(config('queue.reports'));

        return response()->json([
            'data' => [
                'message' => 'Job added to queue'
            ]
        ]);
    }

    /**
     * Немного уже понесло. Напишу выборку тут
     */
    public function list()
    {
        return JobResult::orderBy('job_result_id','desc')->get();
    }
}
