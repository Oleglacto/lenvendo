<?php

namespace App\Http\Resources;

use App\EloquentModels\Bookmark;
use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkResource extends JsonResource
{
    private bool $fullInfo;

    public function __construct($resource, $fullInfo = false)
    {
        parent::__construct($resource);
        $this->fullInfo = $fullInfo;
    }

    public function toArray($request)
    {
        /** @var Bookmark $this  */
        $data = [
            'id' => $this->getKey(),
            'title' => $this->title,
            'url' => $this->url,
            'favicon' => $this->favicon,
            'created_at' => $this->created_at->toDateTimeString(),
        ];

        if ($this->fullInfo) {
            return array_merge($data, [
                'description' => $this->description,
                'keywords' => $this->keywords,
            ]);
        }


        return $data;
    }
}
