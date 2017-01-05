<?php

namespace spec\Day5;

use Day5\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    public $exampleInput = 'abc';

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }
}
