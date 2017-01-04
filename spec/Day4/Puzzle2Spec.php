<?php

namespace spec\Day4;

use Day4\Puzzle2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle2Spec extends ObjectBehavior
{
    public $exampleInput = "qzmt-zixmtkozy-ivhz-343";

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }
}
