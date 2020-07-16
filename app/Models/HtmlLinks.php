<?php

namespace App\Models;

class HtmlLinks
{
    private array $links = [];

    public function pushLink($rel, $href)
    {
        $this->links[] = [
            'rel' => $rel,
            'href' => $href
        ];
    }

    public function getLinksByRel(string $rel): array
    {
        return collect($this->links)->groupBy('rel')->get($rel, collect([]))->toArray();
    }
}
