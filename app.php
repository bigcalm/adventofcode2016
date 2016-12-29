<?php

require_once('vendor/autoload.php');

if ($argc != 3) {
    echo 'Usage: php app.php day_number puzzle_number' . PHP_EOL;
    exit(1);
}

$day = $argv[1];
$puzzle = $argv[2];

$puzzleClassName = 'Day' . $day . '\Puzzle' . $puzzle;

/** @var PuzzleInterface $puzzleClass */
$puzzleClass = new $puzzleClassName();

$input = file_get_contents('src/Day' . $day . '/input.txt');

$result = $puzzleClass->processInputFile($input);

echo 'Result: ' . $result . PHP_EOL;
