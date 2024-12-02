<?php

require __DIR__ . '/../vendor/autoload.php';

// Read file content
$data = explode(PHP_EOL, file_get_contents('data.txt'));

// Part 1
$matrix = [];

foreach ($data as $line) {
    if (empty($line)) break;

    $row = array_map(fn($item) => (int) trim($item), explode(' ', $line));

    $safe = true;

    if ($row[0] > $row[count($row) - 1]) {
        // Possibility of decreasing - reverse row
        $row = array_reverse($row);
    }

    foreach ($row as $key => $value) {
        if ($key == count($row) - 1) break;

        if ($value > $row[$key + 1] || abs($row[$key + 1] - $value) <= 0 || abs($row[$key + 1] - $value) >= 4) {
            $safe = FALSE;
        }
    }

    $matrix[] = $safe;
}

$partOneAnswer = count(array_filter($matrix, fn ($item) => $item === true));

echo "Part 1 answer: {$partOneAnswer}\n";

// Part 2
$matrix = [];

foreach ($data as $line) {
    if (empty($line)) break;

    $row = array_map(fn($item) => (int) trim($item), explode(' ', $line));

    $safe = TRUE;

    if ($row[0] > $row[count($row) - 1]) {
        // Possibility of decreasing - reverse row
        $row = array_reverse($row);
    }

    foreach ($row as $key => $value) {
        if ($key == count($row) - 1) break;

        if ($value > $row[$key + 1] || abs($row[$key + 1] - $value) <= 0 || abs($row[$key + 1] - $value) >= 4) {
            $safe = FALSE;
        }

        if (!$safe) {
            foreach (range(0, count($row) - 1) as $i) {
                $safe   = TRUE;
                $newRow = array_values($row);
                unset($newRow[$i]);
                $newRow = array_values($newRow);

                foreach ($newRow as $newKey => $newValue) {
                    if ($newKey == count($newRow) - 1) break;

                    if ($newValue > $newRow[$newKey + 1] || abs($newRow[$newKey + 1] - $newValue) <= 0 || abs($newRow[$newKey + 1] - $newValue) >= 4) {
                        $safe = FALSE;
                    }
                }

                if ($safe) break;
            }
        }
    }

    $matrix[] = $safe;
}

$partTwoAnswer = count(array_filter($matrix, fn ($item) => $item === true));

echo "Part 2 answer: {$partTwoAnswer}\n";
