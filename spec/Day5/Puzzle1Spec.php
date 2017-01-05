<?php

namespace spec\Day5;

use Day5\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    public $exampleInput = 'abc
    ';

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_parses_the_input_into_a_property()
    {
        $this->parseInput($this->exampleInput);
        $this->input->shouldBe('abc');
    }

    public function it_finds_the_1st_password_character()
    {
        $this->parseInput($this->exampleInput);
        $this->findNextCharacterOfPassword();
        $this->password[0]->shouldBe('1');
        $this->index->shouldBe(3231929);
    }

    public function it_finds_the_2nd_password_character()
    {
        $this->parseInput($this->exampleInput);
        $this->index = 3231929;
        $this->findNextCharacterOfPassword();
        $this->password[0]->shouldBe('8');
        $this->index->shouldBe(5017308);
    }

    public function it_finds_the_3rd_password_character()
    {
        $this->parseInput($this->exampleInput);
        $this->index = 5017308;
        $this->findNextCharacterOfPassword();
        $this->password[0]->shouldBe('f');
    }

    public function it_returns_a_multi_character_password()
    {
        $this->parseInput($this->exampleInput);
        $this->findNextCharacterOfPassword();
        $this->findNextCharacterOfPassword();
        $this->findNextCharacterOfPassword();
        $this->joinPasswordCharacters()->shouldBe('18f');
    }

    public function it_finds_8_password_characters()
    {
        $this->parseInput($this->exampleInput);
        $this->findFullPassword(8)->shouldBe('18f47a30');
    }
}
