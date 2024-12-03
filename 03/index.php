<?php

require __DIR__ . "/../vendor/autoload.php";

// Read file content
$data = file_get_contents('data.txt');

$matches = [];

preg_match_all('/mul\([0-9]{1,3}\,[0-9]{1,3}\)/', $data, $matches);

$partOneAnswer = array_sum(array_map(function ($match) {
    $parts =  explode(',', str_replace(['mul(', ')'], '', $match));
    return $parts[0] * $parts[1];
}, str_replace(['mul(', ')'], '', $matches[0])));

echo "Part 1 answer: {$partOneAnswer}\n";

$matches = [];

preg_match_all("/mul\([0-9]{1,3},[0-9]{1,3}\)|don't\(\)|do\(\)/", $data, $matches);

$doing = true;

$partTwoAnswer = array_sum(array_map(function ($match) use (&$doing) {
    if  ($match === 'do()') {
        $doing = true;
        return 0;
    } else if ($match === "don't()") {
        $doing = false;
        return 0;
    } else if (str_starts_with($match, 'mul') && $doing) {
        $parts = explode(',', str_replace(['mul(', ')'], '', $match));
        return $parts[0] * $parts[1];
    }
    return 0;
}, $matches[0]));

echo "Part 2 answer: {$partTwoAnswer}\n";
