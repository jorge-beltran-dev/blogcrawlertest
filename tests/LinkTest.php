<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Blog\Link;

/**
 * @covers Link
 */
final class LinkTest extends TestCase
{
    public function testLinkSetData()
    {
        $link = new Link;
        $linkData = [
            'url' => 'http://foo.com',
            'link' => 'this is a link to the Foo website',
            'meta description' => 'This is a meta description for the Foo website',
            'keywords' => 'foo, bar',
            'filesize' => '92.3kb'
        ];
        $link->setData($linkData);
        $this->assertEquals($linkData, $link->getData(), 'Error setting link data');
    }
}
