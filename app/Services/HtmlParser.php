<?php

namespace App\Services;

use PHPHtmlParser\Dom;

class HtmlParser
{
    /**
     * @var ParserConfig
     */
    private ParserConfig $config;

    public function __construct(ParserConfig $config)
    {
        $this->config = $config;
    }

    public function parse(): array
    {
        $dom = new Dom();
        $dom->load($this->config->getUrl());
        $itemsToParse = $this->config->getItemsToParse();
        foreach ()
    }
}
