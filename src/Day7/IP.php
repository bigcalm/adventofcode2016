<?php

namespace Day7;

class IP
{
    /** @var string $raw */
    protected $raw;

    /** @var array $supernets */
    protected $supernets = [];

    /** @var array $hypernets */
    protected $hypernets = [];

    /** @var array $supernetAbbaSequences */
    protected $supernetAbbaSequences = [];

    /** @var array $hypernetAbbaSequences  */
    protected $hypernetAbbaSequences = [];

    /** @var array $abaSequences */
    protected $abaSequences = [];

    /** @var array $babSequences */
    protected $babSequences = [];

    /** @var bool $tlsSupported */
    protected $tlsSupported;

    /** @var bool $sslSupported */
    protected $sslSupported = false;

    /**
     * @return string
     */
    public function getRaw(): string
    {
        return $this->raw;
    }

    /**
     * @param string $raw
     */
    public function setRaw(string $raw)
    {
        $this->raw = $raw;
    }

    /**
     * @return array
     */
    public function getSupernets(): array
    {
        return $this->supernets;
    }

    /**
     * @param array $supernets
     */
    public function setSupernets(array $supernets)
    {
        $this->supernets = $supernets;
    }

    /**
     * @param string $supernet
     */
    public function addSupernet(string $supernet)
    {
        $this->supernets[] = $supernet;
    }

    /**
     * @return array
     */
    public function getHypernets(): array
    {
        return $this->hypernets;
    }

    /**
     * @param array $hypernets
     */
    public function setHypernets(array $hypernets)
    {
        $this->hypernets = $hypernets;
    }

    /**
     * @param string $hypernet
     */
    public function addHypernet(string $hypernet)
    {
        $this->hypernets[] = $hypernet;
    }

    /**
     * @return array
     */
    public function getSupernetAbbaSequences(): array
    {
        return $this->supernetAbbaSequences;
    }

    /**
     * @param array $supernetAbbaSequences
     */
    public function setSupernetAbbaSequences(array $supernetAbbaSequences)
    {
        $this->supernetAbbaSequences = $supernetAbbaSequences;
    }

    /**
     * @param string $abbaSequence
     */
    public function addSupernetAbbaSequence(string $abbaSequence)
    {
        $this->supernetAbbaSequences[] = $abbaSequence;
    }

    /**
     * @return array
     */
    public function getHypernetAbbaSequences(): array
    {
        return $this->hypernetAbbaSequences;
    }

    /**
     * @param array $hypernetAbbaSequences
     */
    public function setHypernetAbbaSequences(array $hypernetAbbaSequences)
    {
        $this->hypernetAbbaSequences = $hypernetAbbaSequences;
    }

    /**
     * @param string $hypernetAbbaSequence
     */
    public function addHypernetAbbaSequence(string $hypernetAbbaSequence)
    {
        $this->hypernetAbbaSequences[] = $hypernetAbbaSequence;
    }

    /**
     * @return bool
     */
    public function isTlsSupported(): bool
    {
        return $this->tlsSupported;
    }

    /**
     * @param bool $tlsSupported
     */
    public function setTlsSupported(bool $tlsSupported)
    {
        $this->tlsSupported = $tlsSupported;
    }

    /**
     * @return array
     */
    public function getAbaSequences(): array
    {
        return $this->abaSequences;
    }

    /**
     * @param array $abaSequences
     */
    public function setAbaSequences(array $abaSequences)
    {
        $this->abaSequences = $abaSequences;
    }

    /**
     * @param array $abaSequences
     */
    public function addAbaSequences(array $abaSequences)
    {
        $this->abaSequences = array_merge($this->abaSequences, $abaSequences);
    }

    /**
     * @return array
     */
    public function getBabSequences(): array
    {
        return $this->babSequences;
    }

    /**
     * @param array $babSequences
     */
    public function setBabSequences(array $babSequences)
    {
        $this->babSequences = $babSequences;
    }

    /**
     * @param array $babSequences
     */
    public function addBabSequences(array $babSequences)
    {
        $this->babSequences = array_merge($this->babSequences, $babSequences);
    }

    /**
     * @return bool
     */
    public function isSslSupported(): bool
    {
        return $this->sslSupported;
    }

    /**
     * @param bool $sslSupported
     */
    public function setSslSupported(bool $sslSupported)
    {
        $this->sslSupported = $sslSupported;
    }

    public function __construct($string)
    {
        $this->raw = $string;

        preg_match_all("/\[(?P<hypernets>.*)\]/U", $string, $matches, PREG_PATTERN_ORDER);
        $this->hypernets = $matches['hypernets'];

        // strip out the hypernets
        foreach ($this->hypernets as $hypernet) {
            $string = str_replace('[' . $hypernet . ']', '-', $string);
        }

        $this->supernets = explode('-', $string);
    }
}
