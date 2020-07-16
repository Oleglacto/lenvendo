<?php

namespace App\Services;

use App\Contracts\HtmlHeadTagParserInterface;
use App\Models\HtmlHeadModel;

class HtmlHeadParser
{
    private HtmlHeadTagParserInterface $htmlHeadTagParser;

    public function __construct(HtmlHeadTagParserInterface $htmlHeadTagParser)
    {
        $this->htmlHeadTagParser = $htmlHeadTagParser;
    }

    /**
     * @param string $url
     * @return HtmlHeadModel
     */
    public function parse(string $url): HtmlHeadModel
    {
        $this->htmlHeadTagParser->loadDocument($url);

        return new HtmlHeadModel(
            $url,
            $this->htmlHeadTagParser->getMeta(),
            $this->htmlHeadTagParser->getLinks(),
            $this->htmlHeadTagParser->getTitle(),
            $this->htmlHeadTagParser->getBase(),
            $this->htmlHeadTagParser->getStyles(),
            $this->htmlHeadTagParser->getScripts()
        );
    }
}
