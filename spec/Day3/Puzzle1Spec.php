<?php

namespace spec\Day3;

use Day3\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    public $exampleNumbers = "  5 10 25
";

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_converts_input_sting_into_an_array_and_stores_as_property()
    {
        $this->parseString($this->exampleNumbers);
        $this->getNumberSets()->shouldBeArray();
        $this->getNumberSets()->shouldHaveCount(1);
        $this->getNumberSets()[0]->shouldHaveCount(3);
    }
}
