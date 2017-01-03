<?php

namespace Day2;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    protected $keypad = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ];

    /** @var array $instructions */
    public $instructions = [];

    /** @var int $lastKey */
    public $lastKey;

    public function __construct(array $options = [])
    {
        // no options to manage
    }

    public function processInput(string $input)
    {
        $this->parseString($input);
        return $this->followMultipleLinesOfInstructions($this->instructions);
    }

    public function parseString(string $inputString)
    {
        // remove unwanted CR characters
        $inputString = str_replace("\r", "\n", $inputString);

        // ensure we only have single newlines for each line
        $inputString = str_replace("\n\n", "\n", $inputString);

        // split the string into an array
        $inputArray = explode("\n", trim($inputString));

        $this->instructions = $inputArray;
    }

    /**
     * @return array
     */
    public function getKeypad()
    {
        return $this->keypad;
    }

    /**
     * @return int
     */
    public function getLastKey()
    {
        return $this->lastKey;
    }

    /**
     * @param int|string $key
     * @return array [$row, $column]
     * @throws \Exception when key is not found within $this->keypad array const
     */
    public function locateKey($key)
    {
        // find which row our key is in
        $row = -1;
        for ($i = 0; $i < count($this->keypad); $i++) {
            if (in_array($key, $this->keypad[$i])) {
                $row = $i;
                break;
            }
        }

        if ($row < 0) {
            throw new \Exception(sprintf('Key "%s" is not within $this->keypad', $key));
        }

        // find the position within the row for our key
        $column = array_search($key, $this->keypad[$row]);

        return [$row, $column];
    }

    /**
     * @return $this
     */
    public function moveUp()
    {
        list($row, $column) = $this->locateKey($this->lastKey);

        $targetRow = $row - 1;

        // don't go above top row
        if ($targetRow < 0) {
            $targetRow = $row;
        }

        $this->lastKey = $this->keypad[$targetRow][$column];

        return $this;
    }

    /**
     * @return $this
     */
    public function moveDown()
    {
        list($row, $column) = $this->locateKey($this->lastKey);

        $targetRow = $row + 1;

        // don't go below bottom row
        if ($targetRow >= count($this->keypad) ) {
            $targetRow = $row;
        }

        $this->lastKey = $this->keypad[$targetRow][$column];

        return $this;
    }

    /**
     * @return $this
     */
    public function moveLeft()
    {
        list($row, $column) = $this->locateKey($this->lastKey);

        $targetColumn = $column - 1;

        // don't go left of 1st column
        if ($targetColumn < 0) {
            $targetColumn = $column;
        }

        $this->lastKey = $this->keypad[$row][$targetColumn];

        return $this;
    }

    /**
     * @return $this
     */
    public function moveRight()
    {
        list($row, $column) = $this->locateKey($this->lastKey);

        $targetColumn = $column + 1;

        // don't go left of 1st column
        if ($targetColumn >= count($this->keypad[$row])) {
            $targetColumn = $column;
        }

        $this->lastKey = $this->keypad[$row][$targetColumn];

        return $this;
    }

    /**
     * @param int|string $startKey
     * @param string $instruction
     * @return int $currentKey
     * @throws \Exception when an unknown direction is given
     */
    public function followInstructions($startKey, string $instruction)
    {
        $stringLength = strlen($instruction);

        $this->lastKey = $startKey;

        for ($i = 0; $i < $stringLength; $i++) {
            $char = substr($instruction, $i, 1);
            switch($char) {
                case 'U':
                    $this->moveUp();
                    break;

                case 'D':
                    $this->moveDown();
                    break;

                case 'L':
                    $this->moveLeft();
                    break;

                case 'R':
                    $this->moveRight();
                    break;

                default:
                    throw new \Exception(sprintf('Unknown direction "%s"', $char));
            }
        }

        return $this->lastKey;
    }

    public function followMultipleLinesOfInstructions(array $multipleInstructions)
    {
        $completeCode = '';
        $currentKey = 5;

        foreach ($multipleInstructions as $instruction) {
            $currentKey = $this->followInstructions($currentKey, $instruction);
            $completeCode .= $currentKey;
        }

        return $completeCode;
    }
}
