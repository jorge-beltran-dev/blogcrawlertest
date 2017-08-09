<?php
namespace FileReader;

abstract class FileReader 
{
    protected $source;

    abstract public function read(string $source): string;
}
