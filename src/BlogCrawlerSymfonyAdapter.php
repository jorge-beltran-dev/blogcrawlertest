<?php
namespace BlogCrawler;

require 'BlogCrawler.php';

use Symfony\Component\DomCrawler\Crawler;
use Blog\Link;

class BlogCrawlerSymfonyAdapter extends BlogCrawler
{
    protected function parseLinks(string $indexData, string $category): array
    {
        $links = [];
        $crawler = new Crawler($indexData);
        $crawler = $crawler->filter('#content article');
        $count = $crawler->count();
        for ($i=1; $i <= $count; $i++) {
            $postNode = $crawler->first();
            if ($this->belongsToCategory($category, $postNode)) {
                $this->getLinksInPost($links, $postNode);
            }
            $crawler = $crawler->nextAll();
        }

        return $links;
    }

    protected function belongsToCategory(string $category, Crawler &$crawler): bool
    {
        return $crawler->filter('span.category a')->text() == $category;
    }

    protected function getLinksInPost(array &$links, Crawler $crawler)
    { 
        $crawler = $crawler->filter('.entry-summary ul li');
        $count = $crawler->count();
        for ($i=1; $i <= $count; $i++) {
            $link = $crawler->filter('a')->first();
            $links[] = $this->getLinkData($link);
            $crawler = $crawler->nextAll();
        }
    }

    protected function getLinkData(&$linkNode): Link
    {
        $url = $linkNode->attr('href');
        $linkSource = $this->reader->read($url);

        $linkData = [
            'url' => $url,
            'link' => $linkNode->text(),
            'meta description' => $this->parseDescription($linkSource),
            'keywords' => $this->parseKeywords($linkSource),
            'filesize' => $this->getFileSize($linkSource)
        ];

        $link = new Link;
        $link->setData($linkData);
        return $link;
    }

    protected function parseDescription(string &$source): string
    {
        $crawler = new Crawler($source);
        if ($crawler->filter('meta[name=description]')->count() > 0) {
            return $crawler->filter('meta[name=description]')->first()->attr('content');
        }
        return '';
    }

    protected function parseKeywords(string &$source): string
    {
        $crawler = new Crawler($source);
        if ($crawler->filter('meta[name=keywords]')->count() > 0) {
            return $crawler->filter('meta[name=keywords]')->first()->attr('content');
        }
        return '';
    }

    protected function getFileSize(string &$source): string
    {
        $sizeString = (string) round(strlen($source) / 1024, 1);
        return $sizeString . 'kb';
    }
}
