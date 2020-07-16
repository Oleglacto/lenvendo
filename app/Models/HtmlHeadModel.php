<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class HtmlHeadModel
{
    private string $url;

    private array $scripts;

    private array $styles;

    private ?string $title;

    private HtmlMeta $meta;

    private HtmlLinks $links;

    private ?string $base;

    public function __construct(
        string $url,
        HtmlMeta $meta,
        HtmlLinks $links,
        ?string $title,
        ?string $base,
        array $styles,
        array $scripts
    ) {
        $this->meta = $meta;
        $this->links = $links;
        $this->title = $title;
        $this->base = $base;
        $this->styles = $styles;
        $this->scripts = $scripts;
        $this->url = $url;
    }

    /**
     * @return HtmlMeta
     */
    public function getMeta(): HtmlMeta
    {
        return $this->meta;
    }

    /**
     * @return HtmlLinks
     */
    public function getLinks(): HtmlLinks
    {
        return $this->links;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    public function getFavicon(): string
    {
        $favicon = Arr::get($this->getLinks()->getLinksByRel('shortcut icon'), 0);

        if (!$favicon) {
            if (!empty(file_get_contents($this->url . '/favicon.ico'))) {
                return $this->url . '/favicon.ico';
            }

            return '/images/no-favicon.png';
        }

        if (Str::startsWith($favicon['href'], ['http', 'https', '//'])) {
            return $favicon['href'];
        }

        return Str::start(Str::start($favicon['href'], '/'), $this->url);
    }
}
