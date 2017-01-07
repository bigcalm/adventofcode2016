<?php

namespace spec\Day7;

use Day7\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    /** @var string $exampleInput */
    public $exampleInput = '';

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }
}
