<?php

namespace Day7;

class IP
{
    /** @var string $raw */
    protected $raw;

    /** @var array $subnets */
    protected $subnets = [];

    /** @var array $hypernets */
    protected $hypernets = [];

    /** @var array $subnetAbbaSequences */
    protected $subnetAbbaSequences = [];

    /** @var array $hypernetAbbaSequences  */
    protected $hypernetAbbaSequences = [];

    /** @var bool $tlsSupported */
    protected $tlsSupported;

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
    public function getSubnets(): array
    {
        return $this->subnets;
    }

    /**
     * @param array $subnets
     */
    public function setSubnets(array $subnets)
    {
        $this->subnets = $subnets;
    }

    /**
     * @param string $subnet
     */
    public function addSubnet(string $subnet)
    {
        $this->subnets[] = $subnet;
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
    public function getSubnetAbbaSequences(): array
    {
        return $this->subnetAbbaSequences;
    }

    /**
     * @param array $subnetAbbaSequences
     */
    public function setSubnetAbbaSequences(array $subnetAbbaSequences)
    {
        $this->subnetAbbaSequences = $subnetAbbaSequences;
    }

    /**
     * @param string $abbaSequence
     */
    public function addSubnetAbbaSequence(string $abbaSequence)
    {
        $this->subnetAbbaSequences[] = $abbaSequence;
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


    public function __construct($string)
    {
        $this->raw = $string;

        preg_match_all("/\[(?P<hypernets>.*)\]/U", $string, $matches, PREG_PATTERN_ORDER);
        $this->hypernets = $matches['hypernets'];

        // strip out the hypernets
        foreach ($this->hypernets as $hypernet) {
            $string = str_replace('[' . $hypernet . ']', '-', $string);
        }

        $this->subnets = explode('-', $string);
    }
}
