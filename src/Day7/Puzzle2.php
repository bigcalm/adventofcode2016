<?php

namespace Day7;

use PuzzleInterface;

class Puzzle2 extends Puzzle1 implements PuzzleInterface
{
    /** @var int $numberOfIPsThatSupportSsl */
    public $numberOfIPsThatSupportSsl = 0;

    public function processInput(string $input)
    {
        parent::processInput($input);

        $this->findAbbaSequencesForAllIPs();

        return $this->numberOfIPsThatSupportSsl;
    }

    public function lookForAbaSequences($string)
    {
        $abaSequences = [];

        for ($i = 0; $i < strlen($string); $i++) {
            if ($i >= strlen($string) - 2) {
                // don't bother checking the rest of the string if we're already 2 away from the end
                break;
            }

            $char0 = $string[$i];
            $char1 = $string[$i + 1];
            $char2 = $string[$i + 2];

            if ($char0 === $char1) {
                // beginning of invalid sequence, skip
                continue;
            }

            if ($char0 === $char2) {
                // aba sequence, add it to the list
                $abaSequence = $char0 . $char1 . $char2;

                $abaSequences[] = $abaSequence;
            }
        }

        return $abaSequences;
    }

    public function findAbaAndBabSequencesForAllIPs()
    {
        foreach ($this->IPs as $IP) {

            foreach ($IP->getSupernets() as $supernet) {
                $abaSequences = $this->lookForAbaSequences($supernet);
                if (count($abaSequences) > 0) {
                    $IP->addAbaSequences($abaSequences);
                }
            }

            foreach ($IP->getHypernets() as $hypernet) {
                $babSequences = $this->lookForAbaSequences($hypernet);
                if (count($babSequences) > 0) {
                    $IP->addBabSequences($babSequences);
                }
            }

            $IP->setSslSupported($this->isSslSupported($IP));

            if ($IP->isSslSupported()) {
                $this->numberOfIPsThatSupportSsl++;
            }
        }
    }

    public function isSslSupported(IP $IP)
    {
        foreach ($IP->getAbaSequences() as $abaSequence) {
            $targetBabSequence = $this->invertAbaToBab($abaSequence);

            if (in_array($targetBabSequence, $IP->getBabSequences())) {
                return true;
            }
        }
        return false;
    }

    public function invertAbaToBab($aba)
    {
        $bab = $aba[1] . $aba[0] . $aba[1];

        return $bab;
    }

}
