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

    public function it_converts_input_into_stored_array()
    {
        $this->parseInput($this->exampleInput);
        $this->inputLines->shouldBeArray();
    }

    public function it_sets_target_length_as_property()
    {
        $this->parseInput($this->exampleInput);
        $this->setTargetStringLength();
        $this->targetStringLength->shouldBe(6);
    }

    public function it_creates_an_array_to_hold_letter_counts()
    {
        $this->parseInput($this->exampleInput);
        $this->setTargetStringLength();
        $this->addLettersFromInput($this->inputLines[0]);
        $this->letters->shouldHaveCount(6);
        for ($i = 0; $i < 6; $i++) {
            $this->letters[$i]->shouldBeArray();
        }
    }

    public function it_adds_letter_counts_to_the_letters_parameter()
    {
        $this->parseInput($this->exampleInput);
        $this->setTargetStringLength();
        $this->addLettersFromInput($this->inputLines[0]);
        $this->letters[0]->shouldhaveCount(1);
        $this->letters[0]['e']->shouldBe(1);
        $this->letters[1]['e']->shouldBe(1);
        $this->letters[2]['d']->shouldBe(1);
        $this->letters[3]['a']->shouldBe(1);
        $this->letters[4]['d']->shouldBe(1);
        $this->letters[5]['n']->shouldBe(1);
    }

    public function it_loops_over_full_input_and_increments_letter_counts()
    {
        $this->parseInput($this->exampleInput);
        $this->decodeInput();
        $this->letters[0]['e']->shouldBe(3);
    }

    public function it_decodes_input_to_reveal_answer()
    {
        $this->parseInput($this->exampleInput);
        $this->decodeInput();
        $this->message->shouldBe('easter');
    }
}
