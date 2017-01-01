<?php

namespace Day1;

use PuzzleInterface;
use PHPlot;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    /** @var bool $graphOutput */
    protected $graphOutput = false;

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
