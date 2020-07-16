<?php declare(strict_types=1);

namespace App\EloquentModels;

use App\BookmarkIndexConfigurator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

/**
 * Элоквент модель закладок
 *
 * @property string $favicon
 * @property string $keywords
 * @property string $url
 * @property string $description
 * @property string $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Bookmark extends Model
{
    use Searchable;

    protected $indexConfigurator = BookmarkIndexConfigurator::class;

    protected $primaryKey = 'bookmark_id';

    protected $table = 'bookmarks';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'bookmark_index';
    }

    // Here you can specify a mapping for model fields
    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
            ],
            'url' => [
                'type' => 'text',
            ],
            'keywords' => [
                'type' => 'text',
            ],
            'description' => [
                'type' => 'text',
            ],
        ]
    ];
}
