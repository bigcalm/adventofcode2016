<?php

namespace Day3;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    /** @var array $numberSets */
    protected $numberSets = [];

    /**
     * @return array
     */
    public function getNumberSets()
    {
        return $this->numberSets;
    }

    /**
     * @param $array
     * @return $this
     */
    public function setNumberSets($array)
    {
        $this->numberSets = $array;

        return $this;
    }

    public function __construct(array $options = [])
    {
        // no options to manage
    }

    public function processInput(string $input)
    {
        $this->parseString($input);
    }

    public function parseString($inputString)
    {
        // remove unwanted CR characters
        $inputString = str_replace("\r", "\n", $inputString);

        // ensure we only have single newlines for each line
        $inputString = str_replace("\n\n", "\n", $inputString);

        // split the string into an array
        $inputArray = explode("\n", trim($inputString));

        // split each row into sets of numbers
        $this->numberSets = array_map(
            function($string) {
                return preg_split('/\s+/', trim($string));
            },
            $inputArray
        );
    }
}
