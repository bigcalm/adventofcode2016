<?php

namespace Day6;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    /** @var array $input */
    public $inputLines = [];

    /** @var int $targetStringLength */
    public $targetStringLength = 0;

    /** @var array $letters */
    public $letters = [];

    /** @var string $message */
    public $message = '';

    public function __construct(array $options = [])
    {
        // no configuration options
    }

    public function processInput(string $input)
    {
        $this->parseInput($input);
        $this->decodeInput();

        return $this->message;
    }

    public function parseInput($inputString)
    {
        // remove unwanted CR characters
        $inputString = str_replace("\r", "\n", $inputString);

        // ensure we only have single newlines for each line
        $inputString = str_replace("\n\n", "\n", $inputString);

        // split the string into an array
        $this->inputLines = explode("\n", trim($inputString));

        $stringLength = strlen($this->inputLines[0]);
    }

    public function setTargetStringLength()
    {
        $this->targetStringLength = strlen($this->inputLines[0]);

        return $this;
    }

    public function addLettersFromInput($string)
    {
        for ($i = 0; $i < $this->targetStringLength; $i++) {
            if (!isset($this->letters[$i])) {
                $this->letters[$i] = [];
            }

            $letter = substr($string, $i, 1);
            if (!isset($this->letters[$i][$letter])) {
                $this->letters[$i][$letter] = 0;
            }

            $this->letters[$i][$letter]++;
        }
    }

    public function decodeInput()
    {
        $this->setTargetStringLength();

        // count each letter frequency per column
        foreach ($this->inputLines as $inputLine) {
            $this->addLettersFromInput($inputLine);
        }

        // add most frequent letters to output message
        foreach ($this->letters as $index => $letterCounts) {
            arsort($this->letters[$index]);

            $this->message .= array_keys($this->letters[$index])[0];
        }
    }
}
