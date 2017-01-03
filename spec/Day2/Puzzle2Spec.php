<?php

namespace spec\Day2;

use Day2\Puzzle2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle2Spec extends ObjectBehavior
{
    public $exampleCode = "ULL
RRDDD
LURDL
UUUUD
";

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_locates_key_5_in_row_2_column_0_of_keypad()
    {
        list($row, $column) = $this->locateKey(5);

        $row->shouldBe(2);
        $column->shouldBe(0);
    }

    public function it_locates_key_B_in_row_3_column_2_of_keypad()
    {
        list($row, $column) = $this->locateKey('B');

        $row->shouldBe(3);
        $column->shouldBe(2);
    }

    public function it_moves_up()
    {
        $this->setLastKey(3)->moveUp()->getLastKey()->shouldBe(1);

        $this->setLastKey(6)->moveUp()->getLastKey()->shouldBe(2);
        $this->setLastKey(7)->moveUp()->getLastKey()->shouldBe(3);
        $this->setLastKey(8)->moveUp()->getLastKey()->shouldBe(4);

        $this->setLastKey('A')->moveUp()->getLastKey()->shouldBe(6);
        $this->setLastKey('B')->moveUp()->getLastKey()->shouldBe(7);
        $this->setLastKey('C')->moveUp()->getLastKey()->shouldBe(8);

        $this->setLastKey('D')->moveUp()->getLastKey()->shouldBe('B');


        // this can also be written as:
        $this->setLastKey($this->getKeypad()[1][2])->moveUp()->getLastKey()->shouldBe($this->getKeypad()[0][2]);

        $this->setLastKey($this->getKeypad()[2][1])->moveUp()->getLastKey()->shouldBe($this->getKeypad()[1][1]);
        $this->setLastKey($this->getKeypad()[2][2])->moveUp()->getLastKey()->shouldBe($this->getKeypad()[1][2]);
        $this->setLastKey($this->getKeypad()[2][3])->moveUp()->getLastKey()->shouldBe($this->getKeypad()[1][3]);

        $this->setLastKey($this->getKeypad()[3][1])->moveUp()->getLastKey()->shouldBe($this->getKeypad()[2][1]);
        $this->setLastKey($this->getKeypad()[3][2])->moveUp()->getLastKey()->shouldBe($this->getKeypad()[2][2]);
        $this->setLastKey($this->getKeypad()[3][3])->moveUp()->getLastKey()->shouldBe($this->getKeypad()[2][3]);

        $this->setLastKey($this->getKeypad()[4][2])->moveUp()->getLastKey()->shouldBe($this->getKeypad()[3][2]);
    }

    public function it_does_not_move_above_row_if_value_would_be_0()
    {
        $this->setLastKey(2)->moveUp()->getLastKey()->shouldBe(2);
        $this->setLastKey(4)->moveUp()->getLastKey()->shouldBe(4);

        $this->setLastKey(5)->moveUp()->getLastKey()->shouldBe(5);
        $this->setLastKey(9)->moveUp()->getLastKey()->shouldBe(9);
    }

    public function it_moves_down()
    {
        $this->setLastKey(1)->moveDown()->getLastKey()->shouldBe(3);

        $this->setLastKey(2)->moveDown()->getLastKey()->shouldBe(6);
        $this->setLastKey(3)->moveDown()->getLastKey()->shouldBe(7);
        $this->setLastKey(4)->moveDown()->getLastKey()->shouldBe(8);

        $this->setLastKey(6)->moveDown()->getLastKey()->shouldBe('A');
        $this->setLastKey(7)->moveDown()->getLastKey()->shouldBe('B');
        $this->setLastKey(8)->moveDown()->getLastKey()->shouldBe('C');

        $this->setLastKey('B')->moveDown()->getLastKey()->shouldBe('D');
    }

    public function it_does_not_move_below_row_if_value_would_be_0()
    {
        $this->setLastKey(5)->moveDown()->getLastKey()->shouldBe(5);
        $this->setLastKey(9)->moveDown()->getLastKey()->shouldBe(9);

        $this->setLastKey('A')->moveDown()->getLastKey()->shouldBe('A');
        $this->setLastKey('C')->moveDown()->getLastKey()->shouldBe('C');
    }

    public function it_moves_left()
    {
        $this->setLastKey(3)->moveLeft()->getLastKey()->shouldBe(2);
        $this->setLastKey(4)->moveLeft()->getLastKey()->shouldBe(3);

        $this->setLastKey(6)->moveLeft()->getLastKey()->shouldBe(5);
        $this->setLastKey(7)->moveLeft()->getLastKey()->shouldBe(6);
        $this->setLastKey(8)->moveLeft()->getLastKey()->shouldBe(7);
        $this->setLastKey(9)->moveLeft()->getLastKey()->shouldBe(8);

        $this->setLastKey('B')->moveLeft()->getLastKey()->shouldBe('A');
        $this->setLastKey('C')->moveLeft()->getLastKey()->shouldBe('B');
    }

    public function it_does_not_move_left_of_a_row_if_value_would_be_0()
    {
        $this->setLastKey(1)->moveLeft()->getLastKey()->shouldBe(1);

        $this->setLastKey(2)->moveLeft()->getLastKey()->shouldBe(2);

        $this->setLastKey(5)->moveLeft()->getLastKey()->shouldBe(5);

        $this->setLastKey('A')->moveLeft()->getLastKey()->shouldBe('A');

        $this->setLastKey('D')->moveLeft()->getLastKey()->shouldBe('D');
    }

    public function it_moves_right()
    {
        $this->setLastKey(2)->moveRight()->getLastKey()->shouldBe(3);
        $this->setLastKey(3)->moveRight()->getLastKey()->shouldBe(4);

        $this->setLastKey(5)->moveRight()->getLastKey()->shouldBe(6);
        $this->setLastKey(6)->moveRight()->getLastKey()->shouldBe(7);
        $this->setLastKey(7)->moveRight()->getLastKey()->shouldBe(8);
        $this->setLastKey(8)->moveRight()->getLastKey()->shouldBe(9);

        $this->setLastKey('A')->moveRight()->getLastKey()->shouldBe('B');
        $this->setLastKey('B')->moveRight()->getLastKey()->shouldBe('C');
    }

    public function it_does_not_move_right_of_a_row_if_value_would_be_0()
    {
        $this->setLastKey(1)->moveRight()->getLastKey()->shouldBe(1);

        $this->setLastKey(4)->moveRight()->getLastKey()->shouldBe(4);

        $this->setLastKey(9)->moveRight()->getLastKey()->shouldBe(9);

        $this->setLastKey('C')->moveRight()->getLastKey()->shouldBe('C');

        $this->setLastKey('D')->moveRight()->getLastKey()->shouldBe('D');
    }

    public function it_follows_a_line_of_instructions_starting_at_5_ending_at_5()
    {
        $this->parseString($this->exampleCode);
        $this->followInstructions(5, $this->instructions[0])->shouldBe(5);
    }

    public function it_follows_a_line_of_instructions_starting_at_5_ending_at_D()
    {
        $this->parseString($this->exampleCode);
        $this->followInstructions(5, $this->instructions[1])->shouldBe('D');
    }

    public function it_follows_a_line_of_instructions_starting_at_D_ending_at_B()
    {
        $this->parseString($this->exampleCode);
        $this->followInstructions('D', $this->instructions[2])->shouldBe('B');
    }

    public function it_follows_a_line_of_instructions_starting_at_B_ending_at_3()
    {
        $this->parseString($this->exampleCode);
        $this->followInstructions('B', $this->instructions[3])->shouldBe(3);
    }

    public function it_processes_a_full_set_of_instructions_to_return_a_multi_key_code()
    {
        $this->parseString($this->exampleCode);
        $this->followMultipleLinesOfInstructions($this->instructions)->shouldBe("5DB3");
    }
}
