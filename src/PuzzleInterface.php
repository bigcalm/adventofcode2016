<?php

interface PuzzleInterface
{
    /**
     * PuzzleInterface constructor.
     * @param array $options
     */
    public function __construct(array $options = []);

    /**
     * @param string $input
     * @return mixed
     */
    public function processInput(string $input);
}
