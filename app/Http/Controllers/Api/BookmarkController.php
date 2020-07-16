<?php

namespace App\Http\Controllers\Api;

use App\EloquentModels\Bookmark;
use App\Helpers\ClearUrl;
use App\Http\Requests\BookmarkCreateRequest;
use App\Http\Requests\BookmarkRequest;
use App\Http\Requests\SearchBookmarkRequest;
use App\Http\Resources\BookmarkResource;
use App\Repositories\BookmarkRepository;
use App\Services\HtmlHeadParser;

class BookmarkController
{
    public function make(BookmarkCreateRequest $request, HtmlHeadParser $headParser, BookmarkRepository $repository)
    {
        $url = ClearUrl::clear($request->get('url'));
        $result = $headParser->parse($url);

        return new BookmarkResource($repository->store($result));
    }

    public function list(BookmarkRepository $repository, BookmarkRequest $request)
    {
        return BookmarkResource::collection($repository->get($request->get('sortBy', 'desc')));
    }

    public function show(Bookmark $bookmark)
    {
        return new BookmarkResource($bookmark, true);
    }

    public function search(BookmarkRepository $repository, SearchBookmarkRequest $request)
    {
        return BookmarkResource::collection($repository->search($request->get('query'), $request->get('sortBy', 'desc')));
    }
}
