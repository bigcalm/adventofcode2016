<?php

namespace Day7;

use PuzzleInterface;

class Puzzle1 implements PuzzleInterface
{
    /** @var IP[] $IPs */
    public $IPs = [];

    /** @var int $numberOfIPsThatSupportTls */
    public $numberOfIPsThatSupportTls = 0;

    public function __construct(array $options = [])
    {
        // no config options
    }

    public function processInput(string $input)
    {
        $this->parseString($input);

        $this->findAbbaSequencesForAllIPs();

        return $this->numberOfIPsThatSupportTls;
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
            $this->IPs[] = new IP($inputLine);
        }
    }

    public function lookForAbbaSequence($string)
    {
        $abbaSequence = null;

        for ($i = 0; $i < strlen($string); $i++) {
            if ($i >= strlen($string) - 3) {
                // don't bother checking the rest of the string if we're already 3 away from the end
                break;
            }

            $char0 = $string[$i];
            $char1 = $string[$i + 1];
            $char2 = $string[$i + 2];
            $char3 = $string[$i + 3];

            if ($char0 === $char1) {
                // beginning of invalid sequence, skip
                continue;
            }

            if ($char0 === $char3 && $char1 === $char2) {
                // abba sequence, return it
                $abbaSequence = $char0 . $char1 . $char2 . $char3;

                break;
            }
        }

        return $abbaSequence;
    }

    public function findAbbaSequencesForAllIPs()
    {
        foreach ($this->IPs as $IP) {

            foreach ($IP->getSupernets() as $supernet) {
                $abbaSequence = $this->lookForAbbaSequence($supernet);
                if ($abbaSequence != null) {
                    $IP->addSupernetAbbaSequence($abbaSequence);
                }
            }

            foreach ($IP->getHypernets() as $hypernet) {
                $abbaSequence = $this->lookForAbbaSequence($hypernet);
                if ($abbaSequence != null) {
                    $IP->addHypernetAbbaSequence($abbaSequence);
                }
            }

            $IP->setTlsSupported($this->isTlsSupported($IP));

            if ($IP->isTlsSupported()) {
                $this->numberOfIPsThatSupportTls++;
            }
        }
    }

    public function isTlsSupported(IP $IP)
    {
        if (count($IP->getHypernetAbbaSequences()) > 0) {
            // don't bother checking further if there is an abba sequence in the hypernet
            return false;
        }

        if (count($IP->getSupernetAbbaSequences()) < 1) {
            // no abba sequences in the supernets
            return false;
        }

        return true;
    }
}
