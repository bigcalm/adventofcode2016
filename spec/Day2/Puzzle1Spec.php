<?php

namespace spec\Day2;

use Day2\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    public $exampleCode = "ULL
RRDDD
LURDL
UUUUD";

    public function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_converts_input_sting_into_an_array_and_stores_as_property()
    {
        $this->parseString($this->exampleCode);
        $this->instructions->shouldBeArray();
    }

    public function it_locates_digit_5_in_row_1_column_1_of_KEYPAD()
    {
        $this->locateDigit(5)->shouldBe([1, 1]);
    }

    public function it_correctly_moves_up()
    {
        $this->moveUp(1)->shouldBe(1);
        $this->moveUp(2)->shouldBe(2);
        $this->moveUp(3)->shouldBe(3);

        $this->moveUp(4)->shouldBe(1);
        $this->moveUp(5)->shouldBe(2);
        $this->moveUp(6)->shouldBe(3);

        $this->moveUp(7)->shouldBe(4);
        $this->moveUp(8)->shouldBe(5);
        $this->moveUp(9)->shouldBe(6);
    }

    public function it_correctly_moves_down()
    {
        $this->moveDown(1)->shouldBe(4);
        $this->moveDown(2)->shouldBe(5);
        $this->moveDown(3)->shouldBe(6);

        $this->moveDown(4)->shouldBe(7);
        $this->moveDown(5)->shouldBe(8);
        $this->moveDown(6)->shouldBe(9);

        $this->moveDown(7)->shouldBe(7);
        $this->moveDown(8)->shouldBe(8);
        $this->moveDown(9)->shouldBe(9);
    }

    public function it_correctly_moves_left()
    {
        $this->moveLeft(1)->shouldBe(1);
        $this->moveLeft(2)->shouldBe(1);
        $this->moveLeft(3)->shouldBe(2);

        $this->moveLeft(4)->shouldBe(4);
        $this->moveLeft(5)->shouldBe(4);
        $this->moveLeft(6)->shouldBe(5);

        $this->moveLeft(7)->shouldBe(7);
        $this->moveLeft(8)->shouldBe(7);
        $this->moveLeft(9)->shouldBe(8);
    }

    public function it_correctly_moves_right()
    {
        $this->moveRight(1)->shouldBe(2);
        $this->moveRight(2)->shouldBe(3);
        $this->moveRight(3)->shouldBe(3);

        $this->moveRight(4)->shouldBe(5);
        $this->moveRight(5)->shouldBe(6);
        $this->moveRight(6)->shouldBe(6);

        $this->moveRight(7)->shouldBe(8);
        $this->moveRight(8)->shouldBe(9);
        $this->moveRight(9)->shouldBe(9);
    }


//    public function it_returns_1_for_1st_instruction_set()
//    {
//        $this->parseString($this->exampleCode);
//        $startDigit = 5;
//        $this->processOneLineOfInstructions($startDigit, $this->instructions[0])->shouldBe(1);
//    }
//
//    public function it_returns_9_for_2nd_instruction_set()
//    {
//        $this->parseString($this->exampleCode);
//        $startDigit = 1;
//        $this->processOneLineOfInstructions($startDigit, $this->instructions[1])->shouldBe(9);
//    }
//
//    public function it_returns_8_for_3rd_instruction_set()
//    {
//        $this->parseString($this->exampleCode);
//        $startDigit = 9;
//        $this->processOneLineOfInstructions($startDigit, $this->instructions[2])->shouldBe(8);
//    }
//
//    public function it_returns_5_for_4th_instruction_set()
//    {
//        $this->parseString($this->exampleCode);
//        $startDigit = 8;
//        $this->processOneLineOfInstructions($startDigit, $this->instructions[3])->shouldBe(5);
//    }
}
