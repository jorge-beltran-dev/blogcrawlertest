<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use JsonWriter\JsonWriter;
use Blog\Link;

/**
 * @covers JsonWriter
 */
final class JsonWriterTest extends TestCase
{
    public function testGetJson()
    {
        $linkData1 = [
            "url" => "https://medium.com/@sergiturbadenas/how-i-expose-laravel-permissions-in-vue-js-49dd05bedfce",
            "link" => "How I expose Laravel permissions in Vue.js – Sergi Tur Badenas – Medium",
            "meta description" => "Foo description",
            "keywords" => "foo, keywords",
            "filesize" => "198.2kb"
        ];
        $link1 = new Link;
        $link1->setData($linkData1);

        $linkData2 = [
            "url" => "https://medium.com/@nalsa/send-the-grandmother-to-the-library-4e80df44eb1e",
            "link" => "Send the grandmother to the library. – Mike Wallis – Medium",
            "meta description" => "Foo description",
            "keywords" => "foo, keywords",
            "filesize" => "198.2kb"
        ];
        $link2 = new Link;
        $link2->setData($linkData2);

        $json = new JsonWriter([$link1, $link2]);
        $jsonData = $json->getJson();
        $expected = [
            'results' => [$linkData1, $linkData2],
            'total' => '396.4kb'
        ];
        $this->assertEquals(json_encode($expected), $jsonData);
    }
}
