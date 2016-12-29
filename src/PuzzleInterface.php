<?php

interface PuzzleInterface
{
    /**
     * @param string $inputFile
     * @return mixed
     */
    public function processInputFile(string $inputFile);
}
