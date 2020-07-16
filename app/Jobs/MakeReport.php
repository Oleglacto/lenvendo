<?php declare(strict_types=1);

namespace App\Jobs;

use App\Contracts\ReportFileInterface;
use App\EloquentModels\Bookmark;
use App\EloquentModels\JobResult;
use App\Repositories\BookmarkRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MakeReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $jobResult;

    public function __construct()
    {
        $this->jobResult = JobResult::create([
            'job' => get_class($this),
            'status' => JobResult::STATUS_PROCESSING,
            'result' => ['message' => 'Выполняется']
        ]);
    }

    public function handle(ReportFileInterface $reportFile, BookmarkRepository $repository)
    {
        $reportFile->openFile();

        $repository->getBuilder()->chunkById(2500, function (Collection $collection) use ($reportFile) {
            $collection->each(function (Bookmark $bookmark) use ($reportFile) {
                $reportFile->addRow($bookmark->toArray());
            });
        });

        $pathToFile = $reportFile->closeFile();

        $this->jobResult->update([
            'status' => JobResult::STATUS_DONE,
            'result' => [
                'message' => 'Выполнено',
                'file' => $pathToFile
            ]
        ]);
    }

    /**
     * Обработчик упавшего джоба
     *
     * @param \Exception $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        $this->jobResult->update([
            'status' => JobResult::STATUS_ERROR,
            'result' => [
                'file'      => $exception->getFile(),
                'line'      => $exception->getLine(),
                'message'   => $exception->getMessage(),
            ]
        ]);
    }
}
