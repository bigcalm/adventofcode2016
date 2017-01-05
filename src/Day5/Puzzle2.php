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

            $position = substr($md5, 5, 1);
            $character = substr($md5, 6, 1);

            if (substr($md5, 0, 5) === '00000'
                && preg_match("/^[0-7]$/", $position)
                && !isset($this->password[$position])
            ) {
                $this->password[$position] = $character;
//                var_dump($this->password);
                return;
            }

            $this->index++;
        }
    }

    public function joinPasswordCharacters(): string
    {
        ksort($this->password);

        return parent::joinPasswordCharacters();
    }

    public function findFullPassword(int $length): string
    {
        while(count($this->password) != 8) {
            $this->findNextCharacterOfPassword();
        }

        return $this->joinPasswordCharacters();
    }
}
