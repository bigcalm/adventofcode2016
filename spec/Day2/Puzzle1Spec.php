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

    public function it_locates_key_5_in_row_1_column_1_of_KEYPAD()
    {
        $this->locateKey(5)->shouldBe([1, 1]);
    }

    public function it_moves_up()
    {
        $this->lastKey = 4;
        $this->moveUp()->lastKey->shouldBe(1);
        $this->lastKey = 5;
        $this->moveUp()->lastKey->shouldBe(2);
        $this->lastKey = 6;
        $this->moveUp()->lastKey->shouldBe(3);

        $this->lastKey = 7;
        $this->moveUp()->lastKey->shouldBe(4);
        $this->lastKey = 8;
        $this->moveUp()->lastKey->shouldBe(5);
        $this->lastKey = 9;
        $this->moveUp()->lastKey->shouldBe(6);


        // this can also be written as:
        $this->lastKey = $this->getKeypad()[1][0];
        $this->moveUp()->lastKey->shouldBe($this->getKeypad()[0][0]); // 4 -> 1
        $this->lastKey = $this->getKeypad()[1][1];
        $this->moveUp()->lastKey->shouldBe($this->getKeypad()[0][1]); // 5 -> 2
        $this->lastKey = $this->getKeypad()[1][2];
        $this->moveUp()->lastKey->shouldBe($this->getKeypad()[0][2]); // 6 -> 3

        $this->lastKey = $this->getKeypad()[2][0];
        $this->moveUp()->lastKey->shouldBe($this->getKeypad()[1][0]); // 7 -> 4
        $this->lastKey = $this->getKeypad()[2][1];
        $this->moveUp()->lastKey->shouldBe($this->getKeypad()[1][1]); // 8 -> 5
        $this->lastKey = $this->getKeypad()[2][2];
        $this->moveUp()->lastKey->shouldBe($this->getKeypad()[1][2]); // 9 -> 6
    }

    public function it_does_not_move_above_1st_row()
    {
        $this->lastKey = 1;
        $this->moveUp()->lastKey->shouldBe(1);
        $this->lastKey = 2;
        $this->moveUp()->lastKey->shouldBe(2);
        $this->lastKey = 3;
        $this->moveUp()->lastKey->shouldBe(3);
    }

    public function it_moves_down()
    {
        $this->lastKey = 1;
        $this->moveDown()->lastKey->shouldBe(4);
        $this->lastKey = 2;
        $this->moveDown()->lastKey->shouldBe(5);
        $this->lastKey = 3;
        $this->moveDown()->lastKey->shouldBe(6);

        $this->lastKey = 4;
        $this->moveDown()->lastKey->shouldBe(7);
        $this->lastKey = 5;
        $this->moveDown()->lastKey->shouldBe(8);
        $this->lastKey = 6;
        $this->moveDown()->lastKey->shouldBe(9);
    }

    public function it_does_not_move_below_last_row()
    {
        $this->lastKey = 7;
        $this->moveDown()->lastKey->shouldBe(7);
        $this->lastKey = 8;
        $this->moveDown()->lastKey->shouldBe(8);
        $this->lastKey = 9;
        $this->moveDown()->lastKey->shouldBe(9);
    }

    public function it_moves_left()
    {
        $this->lastKey = 2;
        $this->moveLeft()->lastKey->shouldBe(1);
        $this->lastKey = 3;
        $this->moveLeft()->lastKey->shouldBe(2);

        $this->lastKey = 5;
        $this->moveLeft()->lastKey->shouldBe(4);
        $this->lastKey = 6;
        $this->moveLeft()->lastKey->shouldBe(5);

        $this->lastKey = 8;
        $this->moveLeft()->lastKey->shouldBe(7);
        $this->lastKey = 9;
        $this->moveLeft()->lastKey->shouldBe(8);
    }

    public function it_does_not_move_left_of_1st_column()
    {
        $this->lastKey = 1;
        $this->moveLeft()->lastKey->shouldBe(1);

        $this->lastKey = 4;
        $this->moveLeft()->lastKey->shouldBe(4);

        $this->lastKey = 7;
        $this->moveLeft()->lastKey->shouldBe(7);
    }

    public function it_moves_right()
    {
        $this->lastKey = 1;
        $this->moveRight()->lastKey->shouldBe(2);
        $this->lastKey = 2;
        $this->moveRight()->lastKey->shouldBe(3);

        $this->lastKey = 4;
        $this->moveRight()->lastKey->shouldBe(5);
        $this->lastKey = 5;
        $this->moveRight()->lastKey->shouldBe(6);

        $this->lastKey = 7;
        $this->moveRight()->lastKey->shouldBe(8);
        $this->lastKey = 8;
        $this->moveRight()->lastKey->shouldBe(9);
    }

    public function it_does_not_move_right_of_last_column()
    {
        $this->lastKey = 3;
        $this->moveRight()->lastKey->shouldBe(3);

        $this->lastKey = 6;
        $this->moveRight()->lastKey->shouldBe(6);

        $this->lastKey = 9;
        $this->moveRight()->lastKey->shouldBe(9);
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

    public function it_processes_a_full_set_of_instructions_to_return_a_multi_key_code()
    {
        $this->parseString($this->exampleCode);
        $this->followMultipleLinesOfInstructions($this->instructions)->shouldBe("1985");
    }
}
