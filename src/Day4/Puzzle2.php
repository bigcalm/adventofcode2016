<?php

namespace Day4;

use Day4\Entity\Room;
use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    public function processInput(string $input)
    {
        $this->parseString($input);

        $this->processRooms();

        foreach ($this->getRooms() as $room)
        {
            if (preg_match("/north/", $room->getDecryptedName())) {
                echo $room->getSectorId() . "\t" . $room->getDecryptedName() . PHP_EOL;
            }
        }

        return 'moo';
    }

    public function rotateString(string $string, int $rotateCount): string
    {
        if ($rotateCount > 25) {
            $times = floor($rotateCount / 26);
            $rotateCount -= ($times * 26);
        }

        $result = '';

        $length = strlen($string);
        for($i = 0; $i < $length; $i++)
        {
            if (preg_match("/[a-z]/", $string{$i})) {
                $ascii = ord($string{$i});
                $rotated = $ascii;

                $rotated = $rotated + $rotateCount;
                $rotated > 122 && $rotated += -122 + 96;
                $rotated < 97 && $rotated += -96 + 122;

                $result .= chr($rotated);
            } else {
                $result .= $string{$i};
            }
        }

        return $result;
    }

    public function decryptName(Room $room)
    {
        $decryptedName = $this->rotateString($room->getEncryptedName(), $room->getSectorId());

        $replaceFind = ["/-/"];
        $replaceReplace = [' '];
        $decryptedName = preg_replace($replaceFind, $replaceReplace, $decryptedName);

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
