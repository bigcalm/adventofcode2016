<?php

namespace Day4;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    /** @var array $rooms */
    protected $rooms = [];

    /**
     * @return array
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    public function __construct(array $options = [])
    {
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

        $rooms = array_map(
            function($string) {
                preg_match("/(?P<encrypted_name>.+)-(?P<sector_id>\d+)\[(?P<checksum>.+)\]$/", $string, $matches);

                return [
                    'raw' => $string,
                    'checksum' => $matches['checksum'],
                    'sector_id' => $matches['sector_id'],
                    'encrypted_name' => $matches['encrypted_name'],
                ];
            },
            $inputLines
        );

        $this->rooms = array_reduce(
            $rooms,
            function($result, $item) {
                $result[$item['raw']] = $item;
                return $result;
            });

        return $this;
    }

    public function calculateCharacterFrequency($room)
    {
        // remove dashes
        $encryptedName = str_replace('-', '', $room['encrypted_name']);

        $frequency = [];

        // loop over each character and add to frequency array
        for ($i = 0; $i < strlen($encryptedName); $i++) {
            $char = substr($encryptedName, $i, 1);

            if (!isset($frequency[$char])) {
                $frequency[$char] = 0;
            }

            $frequency[$char]++;
        }

        $this->rooms[$room['raw']]['character_frequency'] = $frequency;

        return $this;
    }

    public function calculateTopFiveCharacters($room)
    {
        // calculate the character frequency 1st
        $this->calculateCharacterFrequency($room);

        // work out the 5 characters to be used against the checksum
        // 1st sort by value
        // 2nd sort by key
        $characterFrequency = $this->rooms[$room['raw']]['character_frequency'];
        array_multisort(
            array_values($characterFrequency), SORT_DESC,
            array_keys($characterFrequency), SORT_ASC,
            $characterFrequency
        );

        // return the top 5 elements
        $topFive = array_slice($characterFrequency, 0, 5);

        $this->rooms[$room['raw']]['top_five_characters'] = implode('', array_keys($topFive));

        return $this;
    }

    public function validateChecksums($room)
    {
        // generate real checksum for encrypted room name
        $this->calculateTopFiveCharacters($room);

        // refetch the room information
        $room = $this->rooms[$room['raw']];

        // compare against the stored checksum
        $this->rooms[$room['raw']]['valid_checksum'] = ($room['checksum'] == $room['top_five_characters']);

        return $this;
    }

    public function sumSectorIdsForRealRooms()
    {
        // loop over all of the rooms, validate their checksums and sum the ones that are real

        $sumTotal = 0;
        foreach ($this->rooms as $room)
        {
            $this->validateChecksums($room);

            if ($this->rooms[$room['raw']]['valid_checksum']) {
                $sumTotal += $room['sector_id'];
            }
        }

        return $sumTotal;
    }
}
