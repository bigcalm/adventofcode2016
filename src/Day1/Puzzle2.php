<?php

namespace Day1;

use PuzzleInterface;
use PHPlot;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    /** @var bool $graphOutput */
    protected $graphOutput = false;

    /** @var array $visited */
    protected $visited = [];

    public function __construct(array $options = [])
    {
        parent::__construct($options);

        if (in_array('--graph-output', $options)) {
            $this->graphOutput = true;
        }
    }

    public function processInput(string $input)
    {
        parent::processInput($input);

        $this->setCurrentLocationAsFirstLocationVisitedTwice();

        if ($this->graphOutput) {
            $this->createGraphFromLocationHistory();
        }

        parent::computeDistance();

        return $this->computedDistance;
    }

    protected function setCurrentLocationAsFirstLocationVisitedTwice()
    {
        $this->currentLocation = ['x' => 0, 'y' => 0];

        // walk through location history, one block at a time

        foreach ($this->locationHistory as $datum) {

            if ($this->currentLocation['x'] < $datum['x']) {
                for ($i = $this->currentLocation['x']; $i < $datum['x']; $i++) {
                    if (!isset($this->visited[$i][$this->currentLocation['y']])) {
                        $this->visited[$i][$this->currentLocation['y']] = 0;
                    }
                    $this->visited[$i][$this->currentLocation['y']]++;

                    // break out of the for loop and foreach loop with the current location set
                    if ($this->visited[$i][$this->currentLocation['y']] == 2) {
                        $this->currentLocation['x'] = $i;
                        break 2;
                    }
                }
            }

            if ($this->currentLocation['x'] > $datum['x']) {
                for ($i = $this->currentLocation['x']; $i > $datum['x']; $i--) {
                    if (!isset($this->visited[$i][$this->currentLocation['y']])) {
                        $this->visited[$i][$this->currentLocation['y']] = 0;
                    }
                    $this->visited[$i][$this->currentLocation['y']]++;

                    // break out of the for loop and foreach loop with the current location set
                    if ($this->visited[$i][$this->currentLocation['y']] == 2) {
                        $this->currentLocation['x'] = $i;
                        break 2;
                    }
                }
            }

            if ($this->currentLocation['y'] < $datum['y']) {
                for ($i = $this->currentLocation['y']; $i < $datum['y']; $i++) {
                    if (!isset($this->visited[$this->currentLocation['x']][$i])) {
                        $this->visited[$this->currentLocation['x']][$i] = 0;
                    }
                    $this->visited[$this->currentLocation['x']][$i]++;

                    // break out of the for loop and foreach loop with the current location set
                    if ($this->visited[$this->currentLocation['x']][$i] == 2) {
                        $this->currentLocation['y'] = $i;
                        break 2;
                    }
                }
            }

            if ($this->currentLocation['y'] > $datum['y']) {
                for ($i = $this->currentLocation['y']; $i > $datum['y']; $i--) {
                    if (!isset($this->visited[$this->currentLocation['x']][$i])) {
                        $this->visited[$this->currentLocation['x']][$i] = 0;
                    }
                    $this->visited[$this->currentLocation['x']][$i]++;

                    // break out of the for loop and foreach loop with the current location set
                    if ($this->visited[$this->currentLocation['x']][$i] == 2) {
                        $this->currentLocation['y'] = $i;
                        break 2;
                    }
                }
            }

            // All bits covered, set the location
            $this->currentLocation = $datum;
        }
    }

    protected  function createGraphFromLocationHistory()
    {
        $data = [];

        $multiplier = 2;

        foreach ($this->locationHistory as $datum) {
            $data[] = ['', $datum['x'] * $multiplier, $datum['y'] * $multiplier];
        }

        $plot = new PHPlot(800 * $multiplier, 600 * $multiplier);
        $plot->SetImageBorderType('plain');

        $plot->SetPlotType('linepoints');
        $plot->SetDataType('data-data');
        $plot->SetDataValues($data);

        $plot->SetPointShapes(['cross']);
        $plot->SetPointSizes(2 * $multiplier);

        # Main plot title:
        $plot->SetTitle('Easter Bunny HQ map');

        $plot->SetIsInline(true);
        $plot->SetFileFormat('png');
        $plot->SetOutputFile('aoc2016-day1-location-history-graph.png');

        $plot->DrawGraph();
    }
}
