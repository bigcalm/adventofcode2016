<?php

namespace spec\Day1;

use Day1\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    function it_converts_input_sting_into_an_array_and_stores_as_property()
    {
        $this->processInput('R2, L3');
        $this->data->shouldBeArray();
    }
}
