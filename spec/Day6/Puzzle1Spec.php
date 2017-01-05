<?php

namespace spec\Day6;

use Day6\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    /** @var string $exampleInput */
    public $exampleInput = 'eedadn
drvtee
eandsr
raavrd
atevrs
tsrnev
sdttsa
rasrtv
nssdts
ntnada
svetve
tesnvt
vntsnd
vrdear
dvrsen
enarar';

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }
}
