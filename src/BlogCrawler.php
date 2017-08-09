<?php
namespace BlogCrawler;

use Blog\Link;

abstract class BlogCrawler
{
    protected $url;

    protected $reader;

    public function __construct(string $url, $reader)
    {
        $this->url = $url;
        $this->reader = $reader;
    }

    public function getLinks(string $category): array
    {
        $indexData = $this->reader->read($this->url);
        return $this->parseLinks($indexData, $category);
    }

    abstract protected function parseLinks(string $indexData, string $category): array;
}
