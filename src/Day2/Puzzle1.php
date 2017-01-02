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

    public $instructions = [];

    public function __construct(array $options = [])
    {
        // no options to manage
    }

    public function processInput(string $input)
    {
        $this->parseString($input);
    }

    public function parseString(string $inputString)
    {
        // remove unwanted CR characters
        $inputString = str_replace("\r", "\n", $inputString);

        // ensure we only have single newlines for each line
        $inputString = str_replace("\n\n", "\n", $inputString);

        // split the string into an array
        $inputArray = explode("\n", $inputString);

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
     * @param int $fromDigit
     * @return int
     */
    public function moveUp(int $fromDigit)
    {
        list($row, $column) = $this->locateDigit($fromDigit);

        $targetRow = $row - 1;

        // don't go above top row
        if ($targetRow < 0) {
            $targetRow = $row;
        }

        return self::KEYPAD[$targetRow][$column];
    }

    /**
     * @param int $fromDigit
     * @return int
     */
    public function moveDown(int $fromDigit)
    {
        list($row, $column) = $this->locateDigit($fromDigit);

        $targetRow = $row + 1;

        // don't go below bottom row
        if ($targetRow >= count(self::KEYPAD) ) {
            $targetRow = $row;
        }

        return self::KEYPAD[$targetRow][$column];
    }

    /**
     * @param int $fromDigit
     * @return int
     */
    public function moveLeft(int $fromDigit)
    {
        list($row, $column) = $this->locateDigit($fromDigit);

        $targetColumn = $column - 1;

        // don't go left of 1st column
        if ($targetColumn < 0) {
            $targetColumn = $column;
        }

        return self::KEYPAD[$row][$targetColumn];
    }

    /**
     * @param int $fromDigit
     * @return int
     */
    public function moveRight(int $fromDigit)
    {
        list($row, $column) = $this->locateDigit($fromDigit);

        $targetColumn = $column + 1;

        // don't go left of 1st column
        if ($targetColumn >= count(self::KEYPAD[$row])) {
            $targetColumn = $column;
        }

        return self::KEYPAD[$row][$targetColumn];
    }
}
