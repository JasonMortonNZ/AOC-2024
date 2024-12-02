<?php

require __DIR__ . '/../vendor/autoload.php';

// Read file content
$data = explode(PHP_EOL, file_get_contents('data.txt'));

// Part 1
$partOneAnswer = 0;

$columnOne = [];
$columnTwo = [];

foreach ($data as $line) {
    if (empty($line)) {
        break;
    }

    $split = explode('  ', $line);
    $columnOne[] = (int) trim($split[0]);
    $columnTwo[] = (int) trim($split[1]);
}

sort($columnOne);
sort($columnTwo);

foreach ($columnOne as $key => $value) {
    $partOneAnswer += abs($value - $columnTwo[$key]);
}

echo "Part 1 answer: {$partOneAnswer}\n";

// Part 2
$similarities = array_map(function ($value) use ($columnTwo) {
    return $value * count(array_filter($columnTwo, fn($item) => $item === $value));
}, $columnOne);

$partTwoAnswer = array_sum($similarities);

echo "Part 2 answer: {$partTwoAnswer}\n";
