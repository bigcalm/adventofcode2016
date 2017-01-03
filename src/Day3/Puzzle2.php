<?php

namespace Day3;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    public function parseString($inputString)
    {
        parent::parseString($inputString);

        $oldSets = $this->numberSets;

        $blocks = count($oldSets);

        $this->numberSets = [];

        for($i = 0; $i < $blocks; $i += 3) {
            $this->numberSets[$i] = [$oldSets[$i][0], $oldSets[$i + 1][0], $oldSets[$i + 2][0]];
            $this->numberSets[$i + 1] = [$oldSets[$i][1], $oldSets[$i + 1][1], $oldSets[$i + 2][1]];
            $this->numberSets[$i + 2] = [$oldSets[$i][2], $oldSets[$i + 1][2], $oldSets[$i + 2][2]];
        }
    }
}
