<?php

namespace Day2;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    protected $keypad = [
        [0, 0, 1, 0, 0],
        [0, 2, 3, 4, 0],
        [5, 6, 7, 8, 9],
        [0, 'A', 'B', 'C', 0],
        [0, 0, 'D', 0, 0],
    ];

    /** @var int|string $lastKey */
    public $lastKey;

    /**
     * @return int|string
     */
    public function getLastKey()
    {
        return $this->lastKey;
    }

    /**
     * @param int|string $key
     * @return $this
     */
    public function setLastKey($key)
    {
        $this->lastKey = $key;

        return $this;
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
        $keypadRows = count($this->keypad);
        for ($i = 0; $i < $keypadRows; $i++) {
            if (in_array($key, $this->keypad[$i], true)) {
                $row = $i;
                break;
            }
        }

        if ($row < 0) {
            throw new \Exception(sprintf('Key "%s" is not within $this->keypad', $key));
        }

        // find the position within the row for our key
        $column = array_search($key, $this->keypad[$row], true);
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

        // don't go above if value would be 0
        if ($this->keypad[$targetRow][$column] === 0) {
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

        // don't go below if value would be 0
        if ($this->keypad[$targetRow][$column] === 0) {
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

        // don't go left if value would be 0
        if ($this->keypad[$row][$targetColumn] === 0) {
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

        // don't go right if value would be 0
        if ($this->keypad[$row][$targetColumn] === 0) {
            $targetColumn = $column;
        }

        $this->lastKey = $this->keypad[$row][$targetColumn];

        return $this;
    }
}
