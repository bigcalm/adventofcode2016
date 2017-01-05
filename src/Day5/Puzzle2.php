<?php

namespace Day5;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    public function findNextCharacterOfPassword()
    {
        $this->index++;

        while(true) {
            $md5 = md5($this->input . $this->index);

            $characterPosition = substr($md5, 5, 1);
            $character = substr($md5, 6, 1);

            if (substr($md5, 0, 5) === '00000'
                && preg_match("/^[0-7]$/", $characterPosition)
                && !isset($this->password[$characterPosition])
            ) {
                $this->password[$characterPosition] = $character;
                return;
            }

            $this->index++;
        }
    }

}
