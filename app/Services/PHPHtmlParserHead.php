<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\HtmlHeadTagParserInterface;
use App\Exceptions\LoadDocumentException;
use App\Models\HtmlLinks;
use App\Models\HtmlMeta;
use Illuminate\Support\Facades\Log;
use PHPHtmlParser\Dom;

class PHPHtmlParserHead implements HtmlHeadTagParserInterface
{
    private Dom $dom;

    private string $url;

    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
    }

    public function getTitle(): ?string
    {
        try {
            return $this->dom->find('title')->text;
        } catch (\Throwable $exception) {
            Log::warning('Title not found', [
                'url' => $this->url
            ]);
            return null;
        }
    }

    public function getScripts(): array
    {
        // TODO: Implement getScripts() method.
        return [];
    }

    public function getStyles(): array
    {
        // TODO: Implement getStyles() method.
        return [];
    }

    public function getLinks(): HtmlLinks
    {
        $htmlLinks = new HtmlLinks();
        $links =  $this->dom->find('link[rel]');

        foreach ($links as $link) {
            try {
                $htmlLinks->pushLink($link->rel, $link->href);
            } catch (\Throwable $exception) {
                continue;
            }
        }

        return $htmlLinks;
    }

    public function getBase(): ?string
    {
        // TODO: Implement getBase() method.
        return null;
    }

    /**
     * @param string $url
     * @throws LoadDocumentException
     */
    public function loadDocument(string $url): void
    {
        $this->url = $url;
        try {
            $this->dom->loadFromUrl($url);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), [
                'url'  => $url,
                'file' => $exception->getFile(),
                'line' => $exception->getLine()
            ]);

            throw new LoadDocumentException($exception->getMessage());
        }
    }

    public function getMeta(): HtmlMeta
    {
        $htmlMeta = new HtmlMeta();
        $meta =  $this->dom->find('meta[name]');

        foreach ($meta as $item) {
            try {
                $htmlMeta->pushMeta($item->name, $item->content);
            } catch (\Throwable $exception) {
                continue;
            }
        }

        return $htmlMeta;
    }
}
