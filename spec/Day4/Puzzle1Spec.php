<?php

namespace spec\Day4;

use Day4\Entity\Room;
use Day4\Model\Rooms;
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

    public function it_converts_input_sting_into_an_array()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()->shouldBeArray();
    }

    public function it_has_4_rooms()
    {
        $this->parseString($this->exampleInput);

        $this->getRooms()->shouldHaveCount(4);
    }

    public function it_converts_the_input_into_room_objects()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]->shouldBeAnInstanceOf(Room::class);
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_raw()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]->getRaw()->shouldBe('aaaaa-bbb-z-y-x-123[abxyz]');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_checksum()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]->getChecksum()->shouldBe('abxyz');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_sector_id()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]->getSectorId()->shouldBeLike('123');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_encrypted_name()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()[0]->getEncryptedName()->shouldBe('aaaaa-bbb-z-y-x');
    }

    public function it_calculates_the_frequency_of_each_character_in_the_encrypted_name()
    {
        $this->parseString($this->exampleInput);
        $this->processRooms();

        $room = $this->getRooms()[0];

        $room->getCharacterFrequency()->shouldBeArray();
        $room->getCharacterFrequency()['a']->shouldBe(5);
        $room->getCharacterFrequency()['b']->shouldBe(3);
        $room->getCharacterFrequency()['x']->shouldBe(1);
        $room->getCharacterFrequency()['y']->shouldBe(1);
        $room->getCharacterFrequency()['z']->shouldBe(1);
    }

    public function it_sets_the_top_five_characters()
    {
        $this->parseString($this->exampleInput);
        $this->processRooms();

        $room = $this->getRooms()[0];

        $room->getTopFiveCharacters()->shouldBe('abxyz');
    }

    public function it_states_if_a_room_checksum_is_valid()
    {
        $this->parseString($this->exampleInput);
        $this->processRooms();

        $room = $this->getRooms()[0];

        $room->isValidChecksum()->shouldBe(true);
    }

    public function it_states_if_a_room_checksum_is_invalid()
    {
        $this->parseString($this->exampleInput);
        $this->processRooms();

        $room = $this->getRooms()[3];

        $room->isValidChecksum()->shouldBe(false);
    }

    public function it_sums_the_sector_ids_of_real_rooms()
    {
        $this->parseString($this->exampleInput);
        $this->processRooms();

        $this->sumSectorIdsForRealRooms()->shouldBe(1514);
    }
}
