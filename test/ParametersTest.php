<?php
namespace GeneticAlgorithm;

class ParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parameters
     */
    private $parameters;

    protected function setUp()
    {
        $this->parameters = new Parameters();
    }

    public function testOrganismPrototype()
    {
        $prototype = $this->createMock(Organism::class);
        $this->assertSame($this->parameters, $this->parameters->setOrganismPrototype($prototype));
        $this->assertEquals($prototype, $this->parameters->getOrganismPrototype());
    }

    public function testPopulationSize()
    {
        $size = 1000;
        $this->assertSame($this->parameters, $this->parameters->setPopulationSize($size));
        $this->assertEquals($size, $this->parameters->getPopulationSize());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testPopulationSizeFailsForNonNaturalNumbers()
    {
        $size = -5;
        $this->parameters->setPopulationSize($size);
    }

    public function testMutateRate()
    {
        $mutateRate = 0.05;
        $this->assertSame($this->parameters, $this->parameters->setMutateRate($mutateRate));
        $this->assertEquals($mutateRate, $this->parameters->getMutateRate());
    }

    public function testBreedRate()
    {
        $breedRate = 0.1;
        $this->assertSame($this->parameters, $this->parameters->setBreedRate($breedRate));
        $this->assertEquals($breedRate, $this->parameters->getBreedRate());
    }

    public function provideBadNumbers()
    {
        return [
            [-1],
            [1.2],
        ];
    }

    /**
     * @param float $badNumber
     * @expectedException \InvalidArgumentException
     * @dataProvider provideBadNumbers
     */
    public function testMutateRateFailsForBadNumbers(float $badNumber)
    {
        $this->parameters->setMutateRate($badNumber);
    }

    /**
     * @param float $badNumber
     * @expectedException \InvalidArgumentException
     * @dataProvider provideBadNumbers
     */
    public function testBreedRateFailsForBadNumbers(float $badNumber)
    {
        $this->parameters->setBreedRate($badNumber);
    }

    public function testFitnessGoal()
    {
        $fitnessGoal = 1002;
        $this->assertSame($this->parameters, $this->parameters->setFitnessGoal($fitnessGoal));
        $this->assertEquals($fitnessGoal, $this->parameters->getFitnessGoal());
    }

    public function testMaxGenerations()
    {
        $maxGenerations = 50;
        $this->assertSame($this->parameters, $this->parameters->setMaxGenerations($maxGenerations));
        $this->assertEquals($maxGenerations, $this->parameters->getMaxGenerations());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMaxGenerationsFailsForNonNaturalNumbers()
    {
        $maxGenerations = 0;
        $this->parameters->setMaxGenerations($maxGenerations);
    }
}
