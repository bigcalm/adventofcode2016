<?php

namespace Day7;

class IP
{
    /** @var string $raw */
    protected $raw;

    /** @var string $subnetAlpha */
    protected $subnetAlpha;

    /** @var string $hypernet */
    protected $hypernet;

    /** @var string $subnetOmega */
    protected $subnetOmega;

    /** @var string|null $subnetAlphaAbbaSequence */
    protected $subnetAlphaAbbaSequence;

    /** @var string|null $hypernetAbbaSequence  */
    protected $hypernetAbbaSequence;

    /** @var string|null $subnetOmegaAbbaSequence */
    protected $subnetOmegaAbbaSequence;

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
     * @return string
     */
    public function getSubnetAlpha(): string
    {
        return $this->subnetAlpha;
    }

    /**
     * @param string $subnetAlpha
     */
    public function setSubnetAlpha(string $subnetAlpha)
    {
        $this->subnetAlpha = $subnetAlpha;
    }

    /**
     * @return string
     */
    public function getHypernet(): string
    {
        return $this->hypernet;
    }

    /**
     * @param string $hypernet
     */
    public function setHypernet(string $hypernet)
    {
        $this->hypernet = $hypernet;
    }

    /**
     * @return string
     */
    public function getSubnetOmega(): string
    {
        return $this->subnetOmega;
    }

    /**
     * @param string $subnetOmega
     */
    public function setSubnetOmega(string $subnetOmega)
    {
        $this->subnetOmega = $subnetOmega;
    }

    /**
     * @return null|string
     */
    public function getSubnetAlphaAbbaSequence()
    {
        return $this->subnetAlphaAbbaSequence;
    }

    /**
     * @param null|string $subnetAlphaAbbaSequence
     */
    public function setSubnetAlphaAbbaSequence($subnetAlphaAbbaSequence)
    {
        $this->subnetAlphaAbbaSequence = $subnetAlphaAbbaSequence;
    }

    /**
     * @return null|string
     */
    public function getHypernetAbbaSequence()
    {
        return $this->hypernetAbbaSequence;
    }

    /**
     * @param null|string $hypernetAbbaSequence
     */
    public function setHypernetAbbaSequence($hypernetAbbaSequence)
    {
        $this->hypernetAbbaSequence = $hypernetAbbaSequence;
    }

    /**
     * @return null|string
     */
    public function getSubnetOmegaAbbaSequence()
    {
        return $this->subnetOmegaAbbaSequence;
    }

    /**
     * @param null|string $subnetOmegaAbbaSequence
     */
    public function setSubnetOmegaAbbaSequence($subnetOmegaAbbaSequence)
    {
        $this->subnetOmegaAbbaSequence = $subnetOmegaAbbaSequence;
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

        preg_match("/^(?P<subnetAlpha>.+)\[(?P<hypernet>.+)\](?P<subnetOmega>.+)$/", $string, $matches);

        $this->subnetAlpha = $matches['subnetAlpha'];
        $this->hypernet = $matches['hypernet'];
        $this->subnetOmega = $matches['subnetOmega'];
    }
}
