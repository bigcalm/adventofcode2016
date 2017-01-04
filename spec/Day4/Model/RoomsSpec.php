<?php

namespace spec\Day4\Model;

use Day4\Entity\Room;
use Day4\Model\Rooms;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Rooms::class);
    }

    public function it_stores_a_room()
    {
        $room = new Room();
        $this->addRoom($room);

        $this->roomExists($room)->shouldBe(true);
    }

    public function it_removes_a_room()
    {
        $room = new Room();
        $this->addRoom($room);
        $this->roomExists($room)->shouldBe(true);

        $this->delRoom($room);
        $this->roomExists($room)->shouldBe(false);
    }

    public function it_returns_an_array_of_stored_rooms()
    {
        for ($i = 0; $i < 5; $i++) {
            $room = new Room();
            $room->setRaw('room ' . $i);
            $this->addRoom($room);
        }

        $this->findAll()->shouldBeArray();
        $this->findAll()->shouldHaveCount(5);
    }

    public function it_returns_a_room_by_property_raw()
    {
        $room = new Room();
        $room->setRaw('my room');

        $this->addRoom($room);
        $this->roomExists($room)->shouldBe(true);

        $this->findByRaw('my room')->shouldBeAnInstanceOf(Room::class);
    }

    public function it_returns_null_for_an_invalid_value_for_the_property_raw()
    {
        $this->findByRaw('this room does not exist')->shouldBeNull();
    }
}
