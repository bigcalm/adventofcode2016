<?php

namespace spec\Day7;

use Day7\Puzzle2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle2Spec extends ObjectBehavior
{
    public $exampleInput = 'aba[bab]xyz
xyx[xyx]xyx
aaa[kek]eke
zazbz[bzb]cdb
rhamaeovmbheijj[hkwbkqzlcscwjkyjulk]ajsxfuemamuqcjccbc
gdlrknrmexvaypu[crqappbbcaplkkzb]vhvkjyadjsryysvj[nbvypeadikilcwg]jwxlimrgakadpxu[dgoanojvdvwfabtt]yqsalmulblolkgsheo
dqpthtgufgzjojuvzvm[eejdhpcqyiydwod]iingwezvcbtowwzc[uzlxaqenhgsebqskn]wcucfmnlarrvdceuxqc[dkwcsxeitcobaylhbvc]klxammurpqgmpsxsr
gmmfbtpprishiujnpdi[wedykxqyntvrkfdzom]uidgvubnregvorgnhm
txxplravpgztjqcw[txgmmtlhmqpmmwp]bmhfgpmafxqwtrpr[inntmjmgqothdzfqgxq]cvtwvembpvdmcvk
';
    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    function it_sets_each_property_of_the_IP_class()
    {
        $this->parseString($this->exampleInput);

        $this->IPs[0]->getRaw()->shouldBe('aba[bab]xyz');

        $this->IPs[0]->getSupernets()->shouldBeArray();
        $this->IPs[0]->getSupernets()[0]->shouldBe('aba');
        $this->IPs[0]->getSupernets()[1]->shouldBe('xyz');

        $this->IPs[0]->getHypernets()->shouldBeArray();
        $this->IPs[0]->getHypernets()[0]->shouldBe('bab');
    }

    function it_detects_an_aba_sequence()
    {
        $this->lookForAbaSequences('qabaw')[0]->shouldBe('aba');
        $this->lookForAbaSequences('rzazbzt')[0]->shouldBe('zaz');
        $this->lookForAbaSequences('rzazbzt')[1]->shouldBe('zbz');
    }

    function it_does_not_return_invalid_aba_sequences()
    {
        $this->lookForAbbaSequence('aaa')->shouldBeNull();
    }

    function it_does_not_detect_an_aba_sequence()
    {
        $this->lookForAbaSequences('abcde')->shouldBeArray();
        $this->lookForAbaSequences('abcde')->shouldHaveCount(0);
    }

    function it_finds_aba_and_bab_sequences_for_each_IP_and_sets_class_properties()
    {
        $this->parseString($this->exampleInput);

        $this->findAbaAndBabSequencesForAllIPs();

        $this->IPs[0]->getAbaSequences()->shouldBeArray();
        $this->IPs[0]->getAbaSequences()->shouldHaveCount(1);
        $this->IPs[0]->getAbaSequences()[0]->shouldBe('aba');
        $this->IPs[0]->getBabSequences()->shouldBeArray();
        $this->IPs[0]->getBabSequences()->shouldHaveCount(1);
        $this->IPs[0]->getBabSequences()[0]->shouldBe('bab');
    }

    function it_inverts_aba_to_bab_sequence()
    {
        $this->invertAbaToBab('aba')->shouldBe('bab');
    }

    function it_supports_ssl()
    {
        $this->parseString($this->exampleInput);

        $this->findAbaAndBabSequencesForAllIPs();

        $this->IPs[0]->isSslSupported()->shouldBe(true);
        $this->IPs[2]->isSslSupported()->shouldBe(true);
        $this->IPs[3]->isSslSupported()->shouldBe(true);
    }

    function it_does_not_support_ssl()
    {
        $this->parseString($this->exampleInput);

        $this->findAbaAndBabSequencesForAllIPs();

        $this->IPs[1]->isSslSupported()->shouldBe(false);
        $this->IPs[4]->isSslSupported()->shouldBe(false);
        $this->IPs[5]->isSslSupported()->shouldBe(false);
        $this->IPs[6]->isSslSupported()->shouldBe(false);
        $this->IPs[7]->isSslSupported()->shouldBe(false);
        $this->IPs[8]->isSslSupported()->shouldBe(false);
    }

    function it_counts_how_many_IPs_support_ssl()
    {
        $this->parseString($this->exampleInput);

        $this->findAbaAndBabSequencesForAllIPs();

        $this->numberOfIPsThatSupportSsl->shouldBe(3);
    }
}
