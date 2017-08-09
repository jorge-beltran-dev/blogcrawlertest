<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use BlogCrawler\BlogCrawlerSymfonyAdapter;


/**
 * @covers BlogCrawlerSymfonyAdapter
 */
final class BlogCrawlerSymfonyAdapterTest extends TestCase
{
    public function testCrawlBlog()
    {
        $fixture = file_get_contents(__DIR__ . '/Fixtures/blog.html');
        $stub = $this->createMock(\FileReader\FileReader::class);
        $stub->method('read')->willReturn($fixture);
        $blogCrawler = new BlogCrawlerSymfonyAdapter('http://foo', $stub);
        $links = $blogCrawler->getLinks('Digitalia');

        $this->assertEquals(12, count($links));

        $expectedLinkData = [
            "url" => "https://medium.com/@sergiturbadenas/how-i-expose-laravel-permissions-in-vue-js-49dd05bedfce",
            "link" => "How I expose Laravel permissions in Vue.js – Sergi Tur Badenas – Medium",
            "meta description" => "Foo description",
            "keywords" => "foo, keywords",
            "filesize" => "198.2kb"
        ];
        $this->assertEquals($expectedLinkData, $links[0]->getData());

        $expectedLinkData = [
            "url" => "https://medium.com/@nalsa/send-the-grandmother-to-the-library-4e80df44eb1e",
            "link" => "Send the grandmother to the library. – Mike Wallis – Medium",
            "meta description" => "Foo description",
            "keywords" => "foo, keywords",
            "filesize" => "198.2kb"
        ];
        $this->assertEquals($expectedLinkData, $links[6]->getData());
    }
}
/*
 */
