<?php

namespace spec\Day5;

use Day5\Puzzle2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle2Spec extends ObjectBehavior
{
    public $exampleInput = 'abc';

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_stores_the_password_character_in_position_1_based_upon_hash()
    {
        $this->parseInput($this->exampleInput);
        $this->findNextCharacterOfPassword();
        $this->password[1]->shouldBe('5');
    }

    public function it_stores_the_password_character_in_position_4_based_upon_hash()
    {
        $this->parseInput($this->exampleInput);
        $this->index = 3231929;
        $this->findNextCharacterOfPassword();
        $this->password[4]->shouldBe('e');
    }

    public function it_finds_8_password_characters()
    {
        $this->parseInput($this->exampleInput);
        $this->findFullPassword(8)->shouldBe('05ace8e3');
    }

}
