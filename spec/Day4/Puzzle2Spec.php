<?php

namespace spec\Day4;

use Day4\Puzzle2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle2Spec extends ObjectBehavior
{
    public $exampleInput = "qzmt-zixmtkozy-ivhz-343[abcde]
";

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_rotates_xyz_to_yza_with_1_rotation()
    {
        $this->rotateString('xyz', 1)->shouldBe('yza');
    }

    public function it_replaces_dashes_with_spaces_in_the_encrypted_name()
    {
        $this->parseString($this->exampleInput);
        $this->processRooms();

        $room = $this->getRooms()[0];

        $room->getDecryptedName()->shouldBe('very encrypted name');
    }
}
