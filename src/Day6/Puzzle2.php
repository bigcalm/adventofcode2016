<?php

namespace Day6;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    public function decodeInput()
    {
        parent::decodeInput();

        $this->message = '';

        // add most infrequent letters to output message
        foreach ($this->letters as $index => $letterCounts) {
            asort($this->letters[$index]);

            $this->message .= array_keys($this->letters[$index])[0];
        }
    }

}
