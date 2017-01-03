<?php

namespace spec\Day3;

use Day3\Puzzle2;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Puzzle2Spec extends ObjectBehavior
{
    public $exampleNumbers = "  5 10 25
3 4 5
4 1 2
";

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle2::class);
    }

    public function it_converts_input_sting_into_an_array_and_stores_as_property()
    {
        $this->parseString($this->exampleNumbers);
        $this->getNumberSets()->shouldBeArray();
        $this->getNumberSets()->shouldHaveCount(3);
        $this->getNumberSets()[0]->shouldHaveCount(3);
    }

    public function it_tests_if_a_number_set_is_not_a_valid_set_of_triangle_measurements()
    {
        $this->parseString($this->exampleNumbers);

        $this->numberSetAreValidMeasurementsForATriangle($this->getNumberSets()[1])->shouldBe(false);
    }

    public function it_tests_if_a_number_set_is_a_valid_set_of_triangle_measurements()
    {
        $this->parseString($this->exampleNumbers);

        $this->numberSetAreValidMeasurementsForATriangle($this->getNumberSets()[0])->shouldBe(true);
    }

    public function it_counts_the_number_of_valid_sets_of_triangle_measurements()
    {
        $this->parseString($this->exampleNumbers);

        $this->countTotalNumberOfValidTriangleMeasurements()->getNumberOfValidTriangleMeasurements()->shouldBe(1);
    }

}
