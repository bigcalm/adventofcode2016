<?php

namespace spec\Day6;

use Day6\Puzzle2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle2Spec extends ObjectBehavior
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
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_decodes_the_input_to_be_the_least_frequent_leters()
    {
        $this->parseInput($this->exampleInput);
        $this->decodeInput();
        $this->message->shouldBe('advent');
    }
}
