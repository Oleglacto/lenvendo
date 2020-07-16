<?php declare(strict_types=1);

namespace App\Contracts;

use App\Models\HtmlLinks;
use App\Models\HtmlMeta;

interface HtmlHeadTagParserInterface
{
    public function getTitle(): ?string;

    public function getMeta(): HtmlMeta;

    public function getScripts(): array;

    public function getStyles(): array;

    public function getLinks(): HtmlLinks;

    public function getBase(): ?string;

    public function loadDocument(string $url): void;
}
