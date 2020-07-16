<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Arr;

class HtmlMeta
{
    private array $meta = [];

    public function pushMeta($name, $content)
    {
        $this->meta[$name] = $content;
    }

    public function getMetaByName($name): ?string
    {
        return Arr::get($this->meta, $name);
    }
}
