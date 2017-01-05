<?php

namespace Day5;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    /** @var bool $animate */
    public $animate = false;

    public $password = ['_', '_', '_', '_', '_', '_', '_', '_'];

    public $sequenceComplete = false;

    public function __construct(array $options = [])
    {
        parent::__construct($options);

        if (in_array('--animate', $options)) {
            $this->animate = true;
        }
    }

    public function findNextCharacterOfPassword()
    {
        $this->index++;

        while(true) {
            $md5 = md5($this->input . $this->index);

            $position = substr($md5, 5, 1);
            $character = substr($md5, 6, 1);

            if (substr($md5, 0, 5) === '00000'
                && preg_match("/^[0-7]$/", $position)
                && $this->password[$position] == '_'
            ) {
                $this->password[$position] = $character;

                if ($this->animate) {
                    echo  $this->joinPasswordCharacters() . "\r";
                }

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
        while(!$this->sequenceComplete) {
            $this->findNextCharacterOfPassword();
            if (!in_array('_', $this->password)) {
                $this->sequenceComplete = true;
            }
        }

        return $this->joinPasswordCharacters();
    }
}
