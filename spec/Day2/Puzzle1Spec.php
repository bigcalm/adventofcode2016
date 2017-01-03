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
UUUUD
";

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

    public function it_moves_up()
    {
        $this->lastDigit = 4;
        $this->moveUp()->lastDigit->shouldBe(1);
        $this->lastDigit = 5;
        $this->moveUp()->lastDigit->shouldBe(2);
        $this->lastDigit = 6;
        $this->moveUp()->lastDigit->shouldBe(3);

        $this->lastDigit = 7;
        $this->moveUp()->lastDigit->shouldBe(4);
        $this->lastDigit = 8;
        $this->moveUp()->lastDigit->shouldBe(5);
        $this->lastDigit = 9;
        $this->moveUp()->lastDigit->shouldBe(6);


        // this can also be written as:
        $this->lastDigit = Puzzle1::KEYPAD[1][0];
        $this->moveUp()->lastDigit->shouldBe(Puzzle1::KEYPAD[0][0]); // 4 -> 1
        $this->lastDigit = Puzzle1::KEYPAD[1][1];
        $this->moveUp()->lastDigit->shouldBe(Puzzle1::KEYPAD[0][1]); // 5 -> 2
        $this->lastDigit = Puzzle1::KEYPAD[1][2];
        $this->moveUp()->lastDigit->shouldBe(Puzzle1::KEYPAD[0][2]); // 6 -> 3

        $this->lastDigit = Puzzle1::KEYPAD[2][0];
        $this->moveUp()->lastDigit->shouldBe(Puzzle1::KEYPAD[1][0]); // 7 -> 4
        $this->lastDigit = Puzzle1::KEYPAD[2][1];
        $this->moveUp()->lastDigit->shouldBe(Puzzle1::KEYPAD[1][1]); // 8 -> 5
        $this->lastDigit = Puzzle1::KEYPAD[2][2];
        $this->moveUp()->lastDigit->shouldBe(Puzzle1::KEYPAD[1][2]); // 9 -> 6
    }

    public function it_does_not_move_above_1st_row()
    {
        $this->lastDigit = 1;
        $this->moveUp()->lastDigit->shouldBe(1);
        $this->lastDigit = 2;
        $this->moveUp()->lastDigit->shouldBe(2);
        $this->lastDigit = 3;
        $this->moveUp()->lastDigit->shouldBe(3);
    }

    public function it_moves_down()
    {
        $this->lastDigit = 1;
        $this->moveDown()->lastDigit->shouldBe(4);
        $this->lastDigit = 2;
        $this->moveDown()->lastDigit->shouldBe(5);
        $this->lastDigit = 3;
        $this->moveDown()->lastDigit->shouldBe(6);

        $this->lastDigit = 4;
        $this->moveDown()->lastDigit->shouldBe(7);
        $this->lastDigit = 5;
        $this->moveDown()->lastDigit->shouldBe(8);
        $this->lastDigit = 6;
        $this->moveDown()->lastDigit->shouldBe(9);
    }

    public function it_does_not_move_below_last_row()
    {
        $this->lastDigit = 7;
        $this->moveDown()->lastDigit->shouldBe(7);
        $this->lastDigit = 8;
        $this->moveDown()->lastDigit->shouldBe(8);
        $this->lastDigit = 9;
        $this->moveDown()->lastDigit->shouldBe(9);
    }

    public function it_moves_left()
    {
        $this->lastDigit = 2;
        $this->moveLeft()->lastDigit->shouldBe(1);
        $this->lastDigit = 3;
        $this->moveLeft()->lastDigit->shouldBe(2);

        $this->lastDigit = 5;
        $this->moveLeft()->lastDigit->shouldBe(4);
        $this->lastDigit = 6;
        $this->moveLeft()->lastDigit->shouldBe(5);

        $this->lastDigit = 8;
        $this->moveLeft()->lastDigit->shouldBe(7);
        $this->lastDigit = 9;
        $this->moveLeft()->lastDigit->shouldBe(8);
    }

    public function it_does_not_move_left_of_1st_column()
    {
        $this->lastDigit = 1;
        $this->moveLeft()->lastDigit->shouldBe(1);

        $this->lastDigit = 4;
        $this->moveLeft()->lastDigit->shouldBe(4);

        $this->lastDigit = 7;
        $this->moveLeft()->lastDigit->shouldBe(7);
    }

    public function it_moves_right()
    {
        $this->lastDigit = 1;
        $this->moveRight()->lastDigit->shouldBe(2);
        $this->lastDigit = 2;
        $this->moveRight()->lastDigit->shouldBe(3);

        $this->lastDigit = 4;
        $this->moveRight()->lastDigit->shouldBe(5);
        $this->lastDigit = 5;
        $this->moveRight()->lastDigit->shouldBe(6);

        $this->lastDigit = 7;
        $this->moveRight()->lastDigit->shouldBe(8);
        $this->lastDigit = 8;
        $this->moveRight()->lastDigit->shouldBe(9);
    }

    public function it_does_not_move_right_of_last_column()
    {
        $this->lastDigit = 3;
        $this->moveRight()->lastDigit->shouldBe(3);

        $this->lastDigit = 6;
        $this->moveRight()->lastDigit->shouldBe(6);

        $this->lastDigit = 9;
        $this->moveRight()->lastDigit->shouldBe(9);
    }

    public function it_follows_a_line_of_instructions_starting_at_5_ending_at_1()
    {
        $this->parseString($this->exampleCode);
        $this->followInstructions(5, $this->instructions[0])->shouldBe(1);
    }

    public function it_follows_a_line_of_instructions_starting_at_1_ending_at_9()
    {
        $this->parseString($this->exampleCode);
        $this->followInstructions(1, $this->instructions[1])->shouldBe(9);
    }

    public function it_follows_a_line_of_instructions_starting_at_9_ending_at_8()
    {
        $this->parseString($this->exampleCode);
        $this->followInstructions(9, $this->instructions[2])->shouldBe(8);
    }

    public function it_follows_a_line_of_instructions_starting_at_8_ending_at_5()
    {
        $this->parseString($this->exampleCode);
        $this->followInstructions(8, $this->instructions[3])->shouldBe(5);
    }

    public function it_processes_a_full_set_of_instructions_to_return_a_multi_digit_code()
    {
        $this->parseString($this->exampleCode);
        $this->followMultipleLinesOfInstructions($this->instructions)->shouldBe("1985");
    }
}
