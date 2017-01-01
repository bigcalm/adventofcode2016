<?php

require_once('vendor/autoload.php');

if ($argc < 3) {
    echo 'Usage: php app.php [--graph-output] day_number puzzle_number' . PHP_EOL;
    exit(1);
}

$cliArguments = $argv;
$scriptName = array_shift($cliArguments);

$options = [];
$inputs = [];
// loop over the given arguments, splitting options into a separate array
while (count($cliArguments)) {
    $value = array_shift($cliArguments);

    if (substr($value, 0, 2) == '--') {
        $options[] = $value;
    } else {
        $inputs[] = $value;
    }
}


$day = $inputs[0];
$puzzle = $inputs[1];

$puzzleClassName = 'Day' . $day . '\Puzzle' . $puzzle;

/** @var PuzzleInterface $puzzleClass */
$puzzleClass = new $puzzleClassName($options);

$input = file_get_contents('src/Day' . $day . '/input.txt');

$result = $puzzleClass->processInput($input);

echo 'Result: ' . $result . PHP_EOL;
