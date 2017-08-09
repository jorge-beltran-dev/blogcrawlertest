<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use FileReader\FileReader;

/**
 * @covers FileReader
 */
final class FileReaderTest extends TestCase
{
    public function testFileReaderReturnSourceContent()
    {
        $stub = $this->createMock(FileReader::class);
        $stub->method('read')->will($this->returnArgument(0));
        $this->assertEquals($stub->read('Foo return text'), 'Foo return text');
    }
}
