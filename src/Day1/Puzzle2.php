<?php

namespace Day1;

class Puzzle2 extends Puzzle1
{
    public function processInput(string $input)
    {
        parent::processInput($input);

        $locationCounts = [];

        foreach ($this->locationHistory as $datum) {
            $location = 'x' . $datum['x'] . 'y' . $datum['y'];

            if (!isset($locationCounts[$location])) {
                $locationCounts[$location] = 0;
            }

            $locationCounts[$location]++;

            if ($locationCounts[$location] == 2) {
                $this->currentLocation = $datum;
                break;
            }
        }

        parent::computeDistance();

        return $this->computedDistance;
    }
}
