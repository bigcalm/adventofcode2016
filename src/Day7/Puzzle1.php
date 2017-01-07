<?php

namespace Day7;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    public function __construct(array $options = [])
    {
        // no config options
    }

    public function processInput(string $input)
    {
        $this->parseString($input);
    }

    public function parseString($inputString)
    {
        // remove unwanted CR characters
        $inputString = str_replace("\r", "\n", $inputString);

        // ensure we only have single newlines for each line
        $inputString = str_replace("\n\n", "\n", $inputString);

        // split the string into an array
        $inputLines = explode("\n", trim($inputString));
    }
}
