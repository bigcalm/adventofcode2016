<?php

namespace spec\Day1;

use Day1\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_converts_input_sting_into_an_array_and_stores_as_property()
    {
        $this->processInput('R2, L3');
        $this->data->shouldBeArray();
    }

    public function it_returns_5_for_test_1()
    {
        $this->processInput('R2, L3')->shouldReturn(5);
    }

    public function it_returns_2_for_test_2()
    {
        $this->processInput('R2, R2, R2')->shouldReturn(2);
    }

    public function it_returns_12_for_test_3()
    {
        $this->processInput('R5, L5, R5, R3')->shouldReturn(12);
    }
}
