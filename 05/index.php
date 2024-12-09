<?php

require __DIR__ . '/../vendor/autoload.php';

// Read file content
$data = explode(PHP_EOL, file_get_contents('test.txt'));

// Part 1
$matrix = [];

foreach ($data as $line) {
    if(!empty(trim($line))) {
        $matrix[] = str_split(trim($line), 1);
    }
}