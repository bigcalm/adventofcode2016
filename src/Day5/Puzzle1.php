<?php

namespace Day5;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    /** @var string $input */
    public $input = '';

    public $index = 0;

    public $password = [];

    public function __construct(array $options = [])
    {
        // no options to manage
    }

    public function processInput(string $input)
    {
        $this->parseInput($input);
        return $this->findFullPassword(8);
    }

    /**
     * @param string $input
     * @return Puzzle1
     */
    public function parseInput(string $input): Puzzle1
    {
        $this->input = trim($input);

        return $this;
    }

    public function findNextCharacterOfPassword()
    {
        $this->index++;

        while(true) {
            $md5 = md5($this->input . $this->index);

            if (substr($md5, 0, 5) === '00000') {
                $this->password[] = substr($md5, 5, 1);
                return;
            }

            $this->index++;
        }
    }

    public function joinPasswordCharacters(): string
    {
        return implode('', $this->password);
    }

    public function findFullPassword(int $length): string
    {
        for ($i = 0; $i < $length; $i++) {
            $this->findNextCharacterOfPassword();
        }

        return $this->joinPasswordCharacters();
    }
}
