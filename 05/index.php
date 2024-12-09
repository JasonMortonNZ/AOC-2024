<?php

require __DIR__ . '/../vendor/autoload.php';

// Read file content
$data = explode("\n\n", file_get_contents('data.txt'));

// Part 1
$rules = explode(PHP_EOL, $data[0]);
$updates = explode(PHP_EOL, $data[1]);

$correct = [];
$incorrect = [];

foreach ($updates as $update) {
    $updateSplit = explode(',', $update);
    $incorrectSplit = $updateSplit;
    $valid = true;

    foreach ($updateSplit as $i => $v) {

        $applicableRules = array_filter($rules, fn ($r) => str_contains($r, "|$v") || str_contains($r, "$v|"));

        foreach ($applicableRules as $applicableRule) {
            [$x, $y] = explode('|', $applicableRule);
            // $updates must contain both numbers to be valid
            if (in_array($x, $updateSplit) && in_array($y, $updateSplit)) {
               // X must come before Y
                $indexX = array_search($x, $updateSplit);
                $indexY = array_search($y, $updateSplit);

                if ($indexX > $indexY) {
                    $valid = false;
                }
            }
        }
    }

    if ($valid) {
        $correct[] = $updateSplit[floor(sizeof($updateSplit) / 2)];
    } else {
        $incorrect[] = $updateSplit;
    }
}

$answerPartOne = array_sum($correct);
echo "Part 1 answer: {$answerPartOne}\n";

// Part 2
$correct = [];

foreach ($incorrect as $split) {
    $updateSplit = $split;
    $changed = true;

    while ($changed) {
        $changed = false;
        foreach ($updateSplit as $i => $v) {

            $applicableRules = array_filter($rules, fn($r) => str_contains($r, "|$v") || str_contains($r, "$v|"));

            foreach ($applicableRules as $applicableRule) {
                [$x, $y] = explode('|', $applicableRule);
                // $updates must contain both numbers to be valid
                if (in_array($x, $updateSplit) && in_array($y, $updateSplit)) {
                    // X must come before Y
                    $indexX = array_search($x, $updateSplit);
                    $indexY = array_search($y, $updateSplit);

                    if ($indexX > $indexY) {
                        $updateSplit[$indexX] = $y;
                        $updateSplit[$indexY] = $x;
                        $changed = true;
                    }
                }
            }
        }
    }

    $correct[] = $updateSplit[floor(sizeof($updateSplit) / 2)];
}

$answerPartTwo = array_sum($correct);
echo "Part 2 answer: {$answerPartTwo}\n";