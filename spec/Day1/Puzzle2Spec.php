<?php

namespace spec\Day1;

use Day1\Puzzle2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle2Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_returns_4_for_test_1()
    {
        $this->processInput('R8, R4, R4, R8')->shouldReturn(4);
    }
}
