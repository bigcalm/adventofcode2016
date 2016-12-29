<?php

namespace spec\Puzzle1;

use Puzzle1\Day1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Day1Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Day1::class);
    }

    public function it_has_process_method()
    {
        $this->processInputFile();
    }
}
