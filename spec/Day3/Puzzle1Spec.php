<?php

namespace spec\Day3;

use Day3\Puzzle1;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle1Spec extends ObjectBehavior
{
    public $exampleNumbers = "  5 10 25
3 4 5
";

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle1::class);
    }

    public function it_converts_input_sting_into_an_array_and_stores_as_property()
    {
        $this->parseString($this->exampleNumbers);
        $this->getNumberSets()->shouldBeArray();
        $this->getNumberSets()->shouldHaveCount(2);
        $this->getNumberSets()[0]->shouldHaveCount(3);
    }

    public function it_tests_if_a_number_set_is_not_a_valid_set_of_triangle_measurements()
    {
        $this->parseString($this->exampleNumbers);

        $this->numberSetAreValidMeasurementsForATriangle($this->getNumberSets()[0])->shouldBe(false);
    }

    public function it_tests_if_a_number_set_is_a_valid_set_of_triangle_measurements()
    {
        $this->parseString($this->exampleNumbers);

        $this->numberSetAreValidMeasurementsForATriangle($this->getNumberSets()[1])->shouldBe(true);
    }

    public function it_counts_the_number_of_valid_sets_of_triangle_measurements()
    {
        $this->parseString($this->exampleNumbers);

        $this->countTotalNumberOfValidTriangleMeasurements()->getNumberOfValidTriangleMeasurements()->shouldBe(1);
    }
}
