<?php
namespace FileReader;

require 'FileReader.php';

class FileHttpReader extends FileReader
{
    public function read(string $source): string
    {
        return @file_get_contents($source);
    }
}
