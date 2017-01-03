<?php

namespace Day3;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    /** @var array $numberSets */
    protected $numberSets = [];

    /** @var int $numberOfValidTriangleMeasurements */
    protected $numberOfValidTriangleMeasurements = 0;

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

    /**
     * @return int
     */
    public function getNumberOfValidTriangleMeasurements()
    {
        return $this->numberOfValidTriangleMeasurements;
    }

    public function __construct(array $options = [])
    {
        // no options to manage
    }

    public function processInput(string $input)
    {
        $this->parseString($input);

        $this->countTotalNumberOfValidTriangleMeasurements();

        return $this->getNumberOfValidTriangleMeasurements();
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

    /**
     * @param array $numbersSet
     * @return bool
     */
    public function numberSetAreValidMeasurementsForATriangle(array $numbersSet)
    {
        if ($numbersSet[0] + $numbersSet[1] > $numbersSet[2]
            && $numbersSet[0] + $numbersSet[2] > $numbersSet[1]
            && $numbersSet[1] + $numbersSet[2] > $numbersSet[0]) {
            return true;
        }

        return false;
    }

    /**
     * @return $this
     */
    public function countTotalNumberOfValidTriangleMeasurements()
    {
        foreach ($this->numberSets as $numberSet) {
            if ($this->numberSetAreValidMeasurementsForATriangle($numberSet)) {
                $this->numberOfValidTriangleMeasurements++;
            }
        }

        return $this;
    }
}
