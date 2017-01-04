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

    /** @var string $decryptedName */
    protected $decryptedName = '';

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
     * @return string
     */
    public function getDecryptedName(): string
    {
        return $this->decryptedName;
    }

    /**
     * @param string $raw
     * @return Room
     */
    public function setRaw(string $raw): Room
    {
        $this->raw = $raw;

        return $this;
    }

    /**
     * @param string $checksum
     * @return Room
     */
    public function setChecksum(string $checksum): Room
    {
        $this->checksum = $checksum;

        return $this;
    }

    /**
     * @param int $sectorId
     * @return Room
     */
    public function setSectorId(int $sectorId): Room
    {
        $this->sectorId = $sectorId;

        return $this;
    }

    /**
     * @param string $encryptedName
     * @return Room
     */
    public function setEncryptedName(string $encryptedName): Room
    {
        $this->encryptedName = $encryptedName;

        return $this;
    }

    /**
     * @param array $characterFrequency
     * @return Room
     */
    public function setCharacterFrequency(array $characterFrequency): Room
    {
        $this->characterFrequency = $characterFrequency;

        return $this;
    }

    /**
     * @param string $topFiveCharacters
     * @return Room
     */
    public function setTopFiveCharacters(string $topFiveCharacters): Room
    {
        $this->topFiveCharacters = $topFiveCharacters;

        return $this;
    }

    /**
     * @param bool $validChecksum
     * @return Room
     */
    public function setValidChecksum(bool $validChecksum): Room
    {
        $this->validChecksum = $validChecksum;

        return $this;
    }

    /**
     * @param string $decryptedName
     * @return Room
     */
    public function setDecryptedName(string $decryptedName): Room
    {
        $this->decryptedName = $decryptedName;

        return $this;
    }
}
