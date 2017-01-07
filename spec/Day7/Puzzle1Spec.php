<?php

namespace spec\Day7;

use Day7\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    /** @var string $exampleInput */
    public $exampleInput = 'abba[mnop]qrst
abcd[bddb]xyyx
aaaa[qwer]tyui
ioxxoj[asdfgh]zxcvbn
';

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    function it_creates_array_from_input_string()
    {
        $this->parseString($this->exampleInput);

        $this->IPs->shouldBeArray();
        $this->IPs->shouldHaveCount(4);
    }

    function it_creates_ip_entities_for_each_input_line()
    {
        $this->parseString($this->exampleInput);

        for ($i = 0; $i < 4; $i++) {
            $this->IPs[$i]->shouldBeAnInstanceOf('Day7\IP');
        }
    }

    function it_sets_each_property_of_the_IP_class()
    {
        $this->parseString($this->exampleInput);

        $this->IPs[0]->getRaw()->shouldBe('abba[mnop]qrst');
        $this->IPs[0]->getSubnetAlpha()->shouldBe('abba');
        $this->IPs[0]->getHypernet()->shouldBe('mnop');
        $this->IPs[0]->getSubnetOmega()->shouldBe('qrst');
    }

    function it_detects_an_abba_sequence()
    {
        $this->lookForAbbaSequence('abba')->shouldBe('abba');
        $this->lookForAbbaSequence('bddb')->shouldBe('bddb');
        $this->lookForAbbaSequence('xyyx')->shouldBe('xyyx');
        $this->lookForAbbaSequence('ioxxoj')->shouldBe('oxxo');
    }

    function it_does_not_return_invalid_abba_sequences()
    {
        $this->lookForAbbaSequence('aaaa')->shouldBeNull();
    }

    function it_finds_abba_sequences_for_each_IP_and_sets_class_properties()
    {
        $this->parseString($this->exampleInput);

        $this->findAbbaSequencesForAllIPs();

        $this->IPs[0]->getSubnetAlphaAbbaSequence()->shouldBe('abba');
        $this->IPs[0]->getHypernetAbbaSequence()->shouldBeNull();
        $this->IPs[0]->getSubnetOmegaAbbaSequence()->shouldBeNull();

        $this->IPs[1]->getSubnetAlphaAbbaSequence()->shouldBeNull();
        $this->IPs[1]->getHypernetAbbaSequence()->shouldBe('bddb');
        $this->IPs[1]->getSubnetOmegaAbbaSequence()->shouldBe('xyyx');

        $this->IPs[2]->getSubnetAlphaAbbaSequence()->shouldBeNull();
        $this->IPs[2]->getHypernetAbbaSequence()->shouldBeNull();
        $this->IPs[2]->getSubnetOmegaAbbaSequence()->shouldBeNull();

        $this->IPs[3]->getSubnetAlphaAbbaSequence()->shouldBe('oxxo');
        $this->IPs[3]->getHypernetAbbaSequence()->shouldBeNull();
        $this->IPs[3]->getSubnetOmegaAbbaSequence()->shouldBeNull();
    }

    function it_supports_tls()
    {
        $this->parseString($this->exampleInput);

        $this->findAbbaSequencesForAllIPs();

        $this->IPs[0]->isTlsSupported()->shouldBe(true);
        $this->IPs[1]->isTlsSupported()->shouldBe(false);
        $this->IPs[2]->isTlsSupported()->shouldBe(false);
        $this->IPs[3]->isTlsSupported()->shouldBe(true);
    }

    function it_does_not_support_tls()
    {
        $this->parseString($this->exampleInput);

        $this->findAbbaSequencesForAllIPs();
    }

    function it_counts_how_many_IPs_support_tls()
    {
        $this->parseString($this->exampleInput);

        $this->findAbbaSequencesForAllIPs();

        $this->numberOfIPsThatSupportTls->shouldBe(2);
    }
}
