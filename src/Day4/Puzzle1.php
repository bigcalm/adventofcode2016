<?php

namespace Day4;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    /** @var array $rooms */
    protected $rooms = [];

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

        // TODO: return a number
    }

    public function parseString($inputString)
    {
        // remove unwanted CR characters
        $inputString = str_replace("\r", "\n", $inputString);

        // ensure we only have single newlines for each line
        $inputString = str_replace("\n\n", "\n", $inputString);

        // split the string into an array
        $inputLines = explode("\n", trim($inputString));

        $this->rooms = array_map(
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
    }
}
