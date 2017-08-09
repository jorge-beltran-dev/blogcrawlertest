<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use FileReader\FileHttpReader;

/**
 * @covers FileHttpReader
 */
final class FileHttpReaderTest extends TestCase
{
    public function testSiteIsAccesible()
    {
        $reader = new FileHttpReader();
        $this->assertNotEquals($reader->read('https://www.black-ink.org/'), false, 'Web site or network is down');
    }
}
