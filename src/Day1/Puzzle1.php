<?php

namespace Day1;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    const LEFT = 'L';
    const RIGHT = 'R';

    const NORTH = 0;
    const EAST = 1;
    const SOUTH = 2;
    const WEST = 3;

    const DIRECTIONS = [self::NORTH, self::EAST, self::SOUTH, self::WEST];

    /** @var array $data */
    public $data = [];

    /** @var string $currentlyFacing */
    public $currentlyFacing = self::NORTH;

    /** @var array $currentLocation */
    protected $currentLocation = ['x' => 0, 'y' => 0];

    /** @var int $computedDistance */
    protected $computedDistance = 0;

    /** @var array $locationHistory */
    protected $locationHistory = [];

    public function processInput(string $input)
    {
        $this->data = $this->parseString($input);

        $this->walkThroughData();

        $this->computeDistance();

        return $this->computedDistance;
    }

    public function parseString(string $inputString)
    {
        // remove unwanted characters
        $inputString = str_replace(' ', '', $inputString);

        // split the string into an array
        $inputArray = explode(',', $inputString);

        $data = [];
        $counter = 0;

        // loop over array to get turn and distance to travel
        foreach ($inputArray as $item) {
            $turn = substr($item, 0, 1);
            $distance = substr($item, 1);

            $data[$counter] = ['turn' => $turn, 'distance' => $distance];
            $counter++;
        }

        return $data;
    }

    public function walkThroughData()
    {
        foreach ($this->data as $datum) {
            switch ($datum['turn']) {
                case self::LEFT:
                    $this->currentlyFacing--;
                    break;

                case self::RIGHT:
                    $this->currentlyFacing++;
                    break;

                default:
                    throw new \Exception(sprintf('Unknown turn "%s"', $datum['turn']));
            }

            // cater for under run
            if ($this->currentlyFacing < 0) {
                $this->currentlyFacing = self::DIRECTIONS[count(self::DIRECTIONS) - 1];
            }

            // cater for over run
            if ($this->currentlyFacing > count(self::DIRECTIONS) - 1) {
                $this->currentlyFacing = 0;
            }

            // move forwards
            switch ($this->currentlyFacing) {
                case self::NORTH:
                    $this->currentLocation['y'] += $datum['distance'];
                    break;

                case self::EAST:
                    $this->currentLocation['x'] += $datum['distance'];
                    break;

                case self::SOUTH:
                    $this->currentLocation['y'] -= $datum['distance'];
                    break;

                case self::WEST:
                    $this->currentLocation['x'] -= $datum['distance'];
                    break;
            }

            $this->locationHistory[] = $this->currentLocation;
        }
    }

    public function computeDistance()
    {
        // using Taxicab geometry https://en.wikipedia.org/wiki/Taxicab_geometry
        // (p1 - q1) + (p2 - q2)

        $this->computedDistance = abs((0 - $this->currentLocation['x']) + (0 - $this->currentLocation['y']));
    }
}
