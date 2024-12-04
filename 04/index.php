<?php

require __DIR__ . '/../vendor/autoload.php';

// Read file content
$data = explode(PHP_EOL, file_get_contents('data.txt'));

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

$answer = $count;

echo "Part 1 answer: {$answer}\n";
