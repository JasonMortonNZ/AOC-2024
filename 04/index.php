<?php

require __DIR__ . '/../vendor/autoload.php';

// Read file content
$data = explode(PHP_EOL, file_get_contents('data.txt'));

// Part 1
$matrix = [];

foreach ($data as $line) {
    if(!empty(trim($line))) {
        $matrix[] = str_split(trim($line), 1);
    }
}

$word = "XMAS";
$count = 0;

function search($matrix, $word, $startRow, $startCol, $deltaRow, $deltaCol): bool
{
    for ($i = 0; $i < strlen($word); $i++) {
        $row = $startRow + $i * $deltaRow;
        $col = $startCol + $i * $deltaCol;
        if ($row < 0 || $row >= count($matrix) || $col < 0 || $col >= count($matrix[0]) || $matrix[$row][$col] != $word[$i]) {
            return false;
        }
    }

    return true;
}

for ($row = 0; $row < count($matrix); $row++) {
    for ($col = 0; $col < count($matrix[0]); $col++) {
        // Map all 8 directions (horizontal, vertical, diagonal)
        $directions = [
            [0, 1], [0, -1],    // Horizontal
            [1, 0], [-1, 0],    // Vertical
            [1, 1], [-1, -1],   // Diagonal down-right, up-left
            [1, -1], [-1, 1]    // Diagonal down-left, up-right
        ];

        foreach ($directions as [$deltaRow, $deltaCol]) {
            if (search($matrix, $word, $row, $col, $deltaRow, $deltaCol)) {
                $count++;
            }
        }
    }
}

$answerPartOne = $count;

echo "Part 1 answer: {$answerPartOne}\n";

// Part 2

// Read file content
$data = explode(PHP_EOL, file_get_contents('data.txt'));

$matrix = [];

foreach ($data as $line) {
    if(!empty(trim($line))) {
        $matrix[] = str_split(trim($line), 1);
    }
}

$count = 0;

for ($row = 1; $row < count($matrix)-1; $row++) {
    for ($col = 1; $col < count($matrix[0])-1; $col++) {
        if ($matrix[$row][$col] == "A") {
            $diagOne = [$matrix[$row-1][$col-1], $matrix[$row+1][$col+1]];
            $diagTwo = [$matrix[$row+1][$col-1], $matrix[$row-1][$col+1]];

            if (in_array('M', $diagOne) && in_array('S', $diagOne) && in_array('M', $diagTwo)  && in_array('S', $diagTwo)) {
                $count++;
            }
            /*if (
                (($matrix[$row-1][$col-1] == "M" && $matrix[$row+1][$col+1] == "S") && ($matrix[$row-1][$col-1] == "S" || $matrix[$row+1][$col+1] == "M"))
                ||
                (($matrix[$row-1][$col-1] == "S" && $matrix[$row+1][$col+1] == "M") && ($matrix[$row-1][$col+1] == "S" || $matrix[$row+1][$col-1] == "M"))
                ||
                (($matrix[$row-1][$col-1] == "S" && $matrix[$row+1][$col+1] == "M") && ($matrix[$row-1][$col+1] == "M" || $matrix[$row+1][$col-1] == "S"))
                ||
                (($matrix[$row-1][$col-1] == "M" && $matrix[$row+1][$col+1] == "S") && ($matrix[$row-1][$col+1] == "S" || $matrix[$row+1][$col-1] == "M"))
            ) {
                $count++;
            }*/
        }
    }
}

$answerPartTwo = $count;

echo "Part 2 answer: {$answerPartTwo}\n";