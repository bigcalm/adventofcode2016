<?php

namespace Day2;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    const KEYPAD = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ];

    /** @var array $instructions */
    public $instructions = [];

    /** @var int $lastDigit */
    public $lastDigit;

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
     * @param int $digit
     * @return array [$row, $column]
     * @throws \Exception when digit is not found within KEYPAD array const
     */
    public function locateDigit(int $digit)
    {
        // find which row our digit is in
        $row = -1;
        for ($i = 0; $i <= 2; $i++) {
            if (in_array($digit, self::KEYPAD[$i])) {
                $row = $i;
                break;
            }
        }

        if ($row < 0) {
            throw new \Exception(sprintf('Digit "%s" is not within KEYPAD', $digit));
        }

        // find the position within the row for our digit
        $column = array_search($digit, self::KEYPAD[$row]);

        return [$row, $column];
    }

    /**
     * @return $this
     */
    public function moveUp()
    {
        list($row, $column) = $this->locateDigit($this->lastDigit);

        $targetRow = $row - 1;

        // don't go above top row
        if ($targetRow < 0) {
            $targetRow = $row;
        }

        $this->lastDigit = self::KEYPAD[$targetRow][$column];

        return $this;
    }

    /**
     * @return $this
     */
    public function moveDown()
    {
        list($row, $column) = $this->locateDigit($this->lastDigit);

        $targetRow = $row + 1;

        // don't go below bottom row
        if ($targetRow >= count(self::KEYPAD) ) {
            $targetRow = $row;
        }

        $this->lastDigit = self::KEYPAD[$targetRow][$column];

        return $this;
    }

    /**
     * @return $this
     */
    public function moveLeft()
    {
        list($row, $column) = $this->locateDigit($this->lastDigit);

        $targetColumn = $column - 1;

        // don't go left of 1st column
        if ($targetColumn < 0) {
            $targetColumn = $column;
        }

        $this->lastDigit = self::KEYPAD[$row][$targetColumn];

        return $this;
    }

    /**
     * @return $this
     */
    public function moveRight()
    {
        list($row, $column) = $this->locateDigit($this->lastDigit);

        $targetColumn = $column + 1;

        // don't go left of 1st column
        if ($targetColumn >= count(self::KEYPAD[$row])) {
            $targetColumn = $column;
        }

        $this->lastDigit = self::KEYPAD[$row][$targetColumn];

        return $this;
    }

    /**
     * @param int $startDigit
     * @param string $instruction
     * @return int $currentDigit
     * @throws \Exception when an unknown direction is given
     */
    public function followInstructions(int $startDigit, string $instruction)
    {
        $stringLength = strlen($instruction);

        $this->lastDigit = $startDigit;

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

        return $this->lastDigit;
    }

    public function followMultipleLinesOfInstructions(array $multipleInstructions)
    {
        $completeCode = '';
        $currentDigit = 5;

        foreach ($multipleInstructions as $instruction) {
            $currentDigit = $this->followInstructions($currentDigit, $instruction);
            $completeCode .= $currentDigit;
        }

        return $completeCode;
    }
}
