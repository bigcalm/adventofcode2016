<?php

namespace spec\Day4;

use Day4\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    public $exampleInput = "aaaaa-bbb-z-y-x-123[abxyz]
a-b-c-d-e-f-g-h-987[abcde]
not-a-real-room-404[oarel]
totally-real-room-200[decoy]
";

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_converts_input_sting_into_an_array_and_stores_as_property()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()->shouldBeArray();
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_raw()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]['raw']->shouldBe('aaaaa-bbb-z-y-x-123[abxyz]');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_checksum()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]['checksum']->shouldBe('abxyz');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_sector_id()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]['sector_id']->shouldBe('123');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_encrypted_name()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]['encrypted_name']->shouldBe('aaaaa-bbb-z-y-x');
    }
}
