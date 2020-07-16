<?php

namespace App\Repositories;

use App\EloquentModels\Bookmark;
use App\Models\HtmlHeadModel;
use Illuminate\Database\Eloquent\Builder;

class BookmarkRepository
{
    public function store(HtmlHeadModel $model)
    {
        $bookmark = new Bookmark;

        $bookmark->url = $model->getUrl();
        $bookmark->description = $model->getMeta()->getMetaByName('description');
        $bookmark->keywords = $model->getMeta()->getMetaByName('keywords');
        $bookmark->title = $model->getTitle();
        $bookmark->favicon = $model->getFavicon();
        $bookmark->save();

        return $bookmark->refresh();
    }

    public function get($order = 'desc', $perPage = 10)
    {
        return Bookmark::orderBy('created_at', $order)->paginate($perPage);
    }

    public function search($query, $order = 'desc', $perPage = 10)
    {
        return Bookmark::search('*'. $query .'*')->orderBy('created_at', $order)->paginate($perPage);
    }

    public function getBuilder(): Builder
    {
        return Bookmark::query();
    }
}
