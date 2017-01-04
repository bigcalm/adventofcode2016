<?php

namespace Day4\Model;

use Day4\Entity\Room;

class Rooms
{
    /** @var Room[] $storage  */
    protected $storage = [];

    /**
     * @param Room $room
     * @return Rooms
     */
    public function addRoom(Room $room): Rooms
    {
        $this->storage[] = $room;

        return $this;
    }

    /**
     * @param Room $room
     * @return Rooms
     */
    public function delRoom(Room $room): Rooms
    {
        foreach ($this->storage as $key => $storedRoom) {
            if ($storedRoom === $room) {
                unset($this->storage[$key]);
            }
        }

        return $this;
    }

    public function roomExists(Room $room): bool
    {
        foreach ($this->storage as $key => $storedRoom) {
            if ($storedRoom === $room) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Room[]
     */
    public function findAll(): array
    {
        return $this->storage;
    }

    /**
     * @param string $rawString
     * @return Room|null
     */
    public function findByRaw(string $rawString)
    {
        foreach ($this->storage as $room) {
            if ($room->getRaw() == $rawString) {
                return $room;
            }
        }

        return null;
    }
}
