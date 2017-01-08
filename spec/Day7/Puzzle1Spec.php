<?php

namespace spec\Day7;

use Day7\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    /** @var string $exampleInput */
    public $exampleInput = 'abba[mnop1]qrst1[mnop2]qrst2[mnop3]qrst3[mnop4]qrst4
abcd[bddb]xyyx[dbbd]yxxy
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

        $this->IPs[0]->getRaw()->shouldBe('abba[mnop1]qrst1[mnop2]qrst2[mnop3]qrst3[mnop4]qrst4');

        $this->IPs[0]->getSubnets()->shouldBeArray();
        $this->IPs[0]->getSubnets()[0]->shouldBe('abba');
        $this->IPs[0]->getSubnets()[1]->shouldBe('qrst1');
        $this->IPs[0]->getSubnets()[2]->shouldBe('qrst2');
        $this->IPs[0]->getSubnets()[3]->shouldBe('qrst3');
        $this->IPs[0]->getSubnets()[4]->shouldBe('qrst4');

        $this->IPs[0]->getHypernets()->shouldBeArray();
        $this->IPs[0]->getHypernets()[0]->shouldBe('mnop1');
        $this->IPs[0]->getHypernets()[1]->shouldBe('mnop2');
        $this->IPs[0]->getHypernets()[2]->shouldBe('mnop3');
        $this->IPs[0]->getHypernets()[3]->shouldBe('mnop4');
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

        $this->IPs[0]->getSubnetAbbaSequences()->shouldBeArray();
        $this->IPs[0]->getSubnetAbbaSequences()->shouldHaveCount(1);
        $this->IPs[0]->getSubnetAbbaSequences()[0]->shouldBe('abba');
        $this->IPs[0]->getHypernetAbbaSequences()->shouldBeArray();
        $this->IPs[0]->getHypernetAbbaSequences()->shouldHaveCount(0);

        $this->IPs[1]->getSubnetAbbaSequences()->shouldBeArray();
        $this->IPs[1]->getSubnetAbbaSequences()->shouldHaveCount(2);
        $this->IPs[1]->getSubnetAbbaSequences()[0]->shouldBe('xyyx');
        $this->IPs[1]->getHypernetAbbaSequences()->shouldBeArray();
        $this->IPs[1]->getHypernetAbbaSequences()->shouldHaveCount(2);
        $this->IPs[1]->getHypernetAbbaSequences()[0]->shouldBe('bddb');

        $this->IPs[2]->getSubnetAbbaSequences()->shouldBeArray();
        $this->IPs[2]->getSubnetAbbaSequences()->shouldHaveCount(0);
        $this->IPs[2]->getHypernetAbbaSequences()->shouldBeArray();
        $this->IPs[2]->getHypernetAbbaSequences()->shouldHaveCount(0);

        $this->IPs[3]->getSubnetAbbaSequences()->shouldBeArray();
        $this->IPs[3]->getSubnetAbbaSequences()->shouldHaveCount(1);
        $this->IPs[3]->getSubnetAbbaSequences()[0]->shouldBe('oxxo');
        $this->IPs[3]->getHypernetAbbaSequences()->shouldBeArray();
        $this->IPs[3]->getHypernetAbbaSequences()->shouldHaveCount(0);
    }

    function it_supports_tls()
    {
        $this->parseString($this->exampleInput);

        $this->findAbbaSequencesForAllIPs();

        $this->IPs[0]->isTlsSupported()->shouldBe(true);
        $this->IPs[3]->isTlsSupported()->shouldBe(true);
    }

    function it_does_not_support_tls()
    {
        $this->parseString($this->exampleInput);

        $this->findAbbaSequencesForAllIPs();

        $this->IPs[1]->isTlsSupported()->shouldBe(false);
        $this->IPs[2]->isTlsSupported()->shouldBe(false);
    }

    function it_counts_how_many_IPs_support_tls()
    {
        $this->parseString($this->exampleInput);

        $this->findAbbaSequencesForAllIPs();

        $this->numberOfIPsThatSupportTls->shouldBe(2);
    }
}
