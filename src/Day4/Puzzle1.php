<?php

namespace Day4;

use PuzzleInterface;
use Day4\Entity\Room;
use Day4\Model\Rooms;

class Puzzle1 implements PuzzleInterface
{
    /** @var Room[] $Rooms */
    protected $Rooms;

    /**
     * @return Room[]
     */
    public function getRooms(): array
    {
        return $this->Rooms->findAll();
    }

    public function __construct(array $options = [])
    {
        if ($this->Rooms == null) {
            $this->Rooms = new Rooms();
        }

        // no options to manage
    }

    public function processInput(string $input)
    {
        $this->parseString($input);

        return $this->sumSectorIdsForRealRooms();
    }

    public function parseString($inputString)
    {
        // remove unwanted CR characters
        $inputString = str_replace("\r", "\n", $inputString);

        // ensure we only have single newlines for each line
        $inputString = str_replace("\n\n", "\n", $inputString);

        // split the string into an array
        $inputLines = explode("\n", trim($inputString));

        foreach ($inputLines as $inputLine) {
            preg_match("/(?P<encrypted_name>.+)-(?P<sector_id>\d+)\[(?P<checksum>.+)\]$/", $inputLine, $matches);

            $room = new Room();
            $room->setRaw($inputLine);
            $room->setChecksum($matches['checksum']);
            $room->setSectorId($matches['sector_id']);
            $room->setEncryptedName($matches['encrypted_name']);

            $this->Rooms->addRoom($room);
        }

        return $this;
    }

    public function calculateCharacterFrequency(Room $room)
    {
        // remove dashes
        $encryptedName = str_replace('-', '', $room->getEncryptedName());

        $frequency = [];

        // loop over each character and add to frequency array
        for ($i = 0; $i < strlen($encryptedName); $i++) {
            $char = substr($encryptedName, $i, 1);

            if (!isset($frequency[$char])) {
                $frequency[$char] = 0;
            }

            $frequency[$char]++;
        }

        $room->setCharacterFrequency($frequency);

        return $this;
    }

    public function calculateTopFiveCharacters(Room $room)
    {
        // work out the 5 characters to be used against the checksum
        // 1st sort by value
        // 2nd sort by key
        $characterFrequency = $room->getCharacterFrequency();
        array_multisort(
            array_values($characterFrequency), SORT_DESC,
            array_keys($characterFrequency), SORT_ASC,
            $characterFrequency
        );

        // return the top 5 elements
        $topFive = array_slice($characterFrequency, 0, 5);

        $room->setTopFiveCharacters(implode('', array_keys($topFive)));

        return $this;
    }

    public function validateChecksum(Room $room)
    {
        // compare against the stored checksum
        $room->setValidChecksum($room->getChecksum() == $room->getTopFiveCharacters());

        return $this;
    }

    public function sumSectorIdsForRealRooms()
    {
        // loop over all of the rooms, validate their checksums and sum the ones that are real

        $sumTotal = 0;
        foreach ($this->getRooms() as $room)
        {
            if ($room->isValidChecksum()) {
                $sumTotal += $room->getSectorId();
            }
        }

        return $sumTotal;
    }

    public function processRooms()
    {
        foreach ($this->getRooms() as $room) {
            $this->calculateCharacterFrequency($room);
            $this->calculateTopFiveCharacters($room);
            $this->validateChecksum($room);
        }
    }
}
