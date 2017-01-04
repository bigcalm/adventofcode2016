<?php

namespace Day4\Entity;

class Room
{
    /** @var string $raw */
    protected $raw;

    /** @var string $raw */
    protected $checksum = '';

    /** @var int $sectorId */
    protected $sectorId = 0;

    /** @var string $encryptedName */
    protected $encryptedName = '';

    /** @var array $characterFrequency */
    protected $characterFrequency = [];

    /** @var string $topFiveCharacters */
    protected $topFiveCharacters = '';

    /** @var bool $validChecksum */
    protected $validChecksum = false;

    /**
     * @return string
     */
    public function getRaw(): string
    {
        return $this->raw;
    }

    /**
     * @return string
     */
    public function getChecksum(): string
    {
        return $this->checksum;
    }

    /**
     * @return int
     */
    public function getSectorId(): int
    {
        return $this->sectorId;
    }

    /**
     * @return string
     */
    public function getEncryptedName(): string
    {
        return $this->encryptedName;
    }

    /**
     * @return array
     */
    public function getCharacterFrequency(): array
    {
        return $this->characterFrequency;
    }

    /**
     * @return string
     */
    public function getTopFiveCharacters(): string
    {
        return $this->topFiveCharacters;
    }

    /**
     * @return bool
     */
    public function isValidChecksum(): bool
    {
        return $this->validChecksum;
    }

    /**
     * @param string $raw
     * @return $this
     */
    public function setRaw(string $raw)
    {
        $this->raw = $raw;

        return $this;
    }

    /**
     * @param string $checksum
     * @return $this
     */
    public function setChecksum(string $checksum)
    {
        $this->checksum = $checksum;

        return $this;
    }

    /**
     * @param int $sectorId
     * @return $this
     */
    public function setSectorId(int $sectorId)
    {
        $this->sectorId = $sectorId;

        return $this;
    }

    /**
     * @param string $encryptedName
     * @return $this
     */
    public function setEncryptedName(string $encryptedName)
    {
        $this->encryptedName = $encryptedName;

        return $this;
    }

    /**
     * @param array $characterFrequency
     * @return $this
     */
    public function setCharacterFrequency(array $characterFrequency)
    {
        $this->characterFrequency = $characterFrequency;

        return $this;
    }

    /**
     * @param string $topFiveCharacters
     * @return $this
     */
    public function setTopFiveCharacters(string $topFiveCharacters)
    {
        $this->topFiveCharacters = $topFiveCharacters;

        return $this;
    }

    /**
     * @param bool $validChecksum
     * @return $this
     */
    public function setValidChecksum(bool $validChecksum)
    {
        $this->validChecksum = $validChecksum;

        return $this;
    }
}
