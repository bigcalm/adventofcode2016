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
        $this->getRooms()->shouldHaveKey('aaaaa-bbb-z-y-x-123[abxyz]');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_raw()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']->shouldHaveKeyWithValue('raw', 'aaaaa-bbb-z-y-x-123[abxyz]');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_checksum()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']->shouldHaveKeyWithValue('checksum', 'abxyz');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_sector_id()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']->shouldHaveKeyWithValue('sector_id', '123');
    }

    public function it_splits_the_raw_room_strings_into_usable_chunks_encrypted_name()
    {
        $this->parseString($this->exampleInput);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']->shouldHaveKeyWithValue('encrypted_name', 'aaaaa-bbb-z-y-x');
    }

    public function it_calculates_the_frequency_of_each_character_in_the_encrypted_name()
    {
        $this->parseString($this->exampleInput);
        $this->calculateCharacterFrequency($this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']['character_frequency']->shouldBeArray();
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']['character_frequency']['a']->shouldBe(5);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']['character_frequency']['b']->shouldBe(3);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']['character_frequency']['x']->shouldBe(1);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']['character_frequency']['y']->shouldBe(1);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']['character_frequency']['z']->shouldBe(1);
    }

    public function it_sets_the_top_five_characters()
    {
        $this->parseString($this->exampleInput);
        $this->calculateTopFiveCharacters($this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']['top_five_characters']->shouldBe('abxyz');
    }

    public function it_states_if_a_room_checksum_is_valid()
    {
        $this->parseString($this->exampleInput);
        $this->validateChecksums($this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']);
        $this->getRooms()['aaaaa-bbb-z-y-x-123[abxyz]']['valid_checksum']->shouldBe(true);
    }

    public function it_states_if_a_room_checksum_is_invalid()
    {
        $this->parseString($this->exampleInput);
        $this->validateChecksums($this->getRooms()['totally-real-room-200[decoy]']);
        $this->getRooms()['totally-real-room-200[decoy]']['valid_checksum']->shouldBe(false);
    }

    public function it_sums_the_sector_ids_of_real_rooms()
    {
        $this->parseString($this->exampleInput);
        $this->sumSectorIdsForRealRooms()->shouldBe(1514);
    }
}
