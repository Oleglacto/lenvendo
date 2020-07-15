<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BookmarkRequest;
use App\Services\HtmlParser;

class BookmarkController
{
    public function make(BookmarkRequest $request, HtmlParser $parser)
    {
        $parser->loadDocument($request->get('url'));
        dd($parser->getBySelector('123'));
    }
}
