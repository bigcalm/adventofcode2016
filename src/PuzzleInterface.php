<?php

interface PuzzleInterface
{
    /**
     * @param string $input
     * @return mixed
     */
    public function processInput(string $input);
}
