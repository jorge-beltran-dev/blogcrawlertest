<?php
include 'vendor/autoload.php';

use FileReader\FileHttpReader;
use BlogCrawler\BlogCrawlerSymfonyAdapter;
use JsonWriter\JsonWriter;

$reader = new FileHttpReader();
$crawl = new BlogCrawlerSymfonyAdapter($argv[1], $reader);
$links = $crawl->getLinks($argv[2]);
$json = new JsonWriter($links);
echo $json->getJson();
