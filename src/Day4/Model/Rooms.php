<?php

namespace Day4\Model;

use Day4\Entity\Room;

class Rooms
{
    /** @var \SplObjectStorage $rooms  */
    protected $rooms;

    public function __construct()
    {
        if ($this->rooms === null) {
            $this->rooms = new \SplObjectStorage();
        }
    }

    /**
     * @return \SplObjectStorage
     */
    public function getRooms(): \SplObjectStorage
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): Rooms
    {
        $this->rooms->attach($room);

        return $this;
    }

    public function delRoom(Room $room): Rooms
    {
        $this->rooms->detach($room);

        return $this;
    }

    /**
     * @param string $rawString
     * @return Room|null
     */
    public function getRoomByRaw(string $rawString)
    {
        $this->rooms->rewind();

        while ($this->rooms->valid()) {
            /** @var Room $object */
            $object = $this->rooms->current();
            if ($object->getRaw() == $rawString) {
                return $object;
            }
        }

        return null;
    }
}
