<?php

namespace App\Services;


class ParserConfig
{
    /**
     * @var string
     */
    private string $url;

    /**
     * @var array
     */
    private array $itemsToParse;

    public function __construct(string $url, array $itemsToParse)
    {
        $this->url = $url;
        $this->itemsToParse = $itemsToParse;
    }

    /**
     * @return array
     */
    public function getItemsToParse(): array
    {
        return $this->itemsToParse;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
