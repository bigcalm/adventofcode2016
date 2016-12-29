<?php

require_once('vendor/autoload.php');

if ($argc != 2) {
    echo 'Usage: php app.php day_number puzzle_number' . PHP_EOL;
}

$day = $argv[1];
$puzzle = $argv[2];

$puzzleClassName = 'Day' . $day . '/Puzzle' . $puzzle;

$puzzleClass = new $puzzleClassName();

$input = file_get_contents('src/Day' . $day . '/input.txt');

$result = $puzzleClass->processInputFile($inputFile);

echo 'Result: ' . $result . PHP_EOL;
