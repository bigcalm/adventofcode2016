<?php

namespace Day4;

use Day4\Entity\Room;
use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{


    public function rotateString(string $string, int $rotateCount): string
    {
        $result = '';

        $length = strlen($string);
        for($i = 0; $i < $length; $i++)
        {
            $ascii = ord($string{$i});
            $rotated = $ascii;

            $rotated = $rotated + $rotateCount;
            $rotated > 122 && $rotated += -122 + 96;
            $rotated < 97 && $rotated += -96 + 122;

            $result .= chr($rotated);
        }

        return $result;
    }

    public function decryptName(Room $room)
    {
        $decryptedName = $this->rotateString($room->getEncryptedName(), $room->getSectorId());

        $room->setDecryptedName($decryptedName);

        return $this;
    }

    public function processRooms()
    {
        parent::processRooms();

        foreach ($this->getRooms() as $room) {
            $this->decryptName($room);
        }
    }
}
