<?php
namespace GeneticAlgorithm;

use PHPUnit\Framework\TestCase;

class ParametersTest extends TestCase
{
    /**
     * @var Parameters
     */
    private $parameters;

    protected function setUp(): void
    {
        $this->parameters = new Parameters();
    }

    public function testOrganismFactory()
    {
        $prototype = $this->createMock(OrganismFactory::class);
        $this->assertSame($this->parameters, $this->parameters->setOrganismFactory($prototype));
        $this->assertEquals($prototype, $this->parameters->getOrganismFactory());
    }

    public function testPopulationSize()
    {
        $size = 1000;
        $this->assertSame($this->parameters, $this->parameters->setPopulationSize($size));
        $this->assertEquals($size, $this->parameters->getPopulationSize());
    }

    public function testPopulationSizeFailsForNonNaturalNumbers()
    {
        $size = -5;
        $this->expectException(\InvalidArgumentException::class);
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
     * @dataProvider provideBadNumbers
     */
    public function testMutateRateFailsForBadNumbers(float $badNumber)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->parameters->setMutateRate($badNumber);
    }

    /**
     * @param float $badNumber
     * @dataProvider provideBadNumbers
     */
    public function testBreedRateFailsForBadNumbers(float $badNumber)
    {
        $this->expectException(\InvalidArgumentException::class);
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

    public function testMaxGenerationsFailsForNonNaturalNumbers()
    {
        $maxGenerations = 0;
        $this->expectException(\InvalidArgumentException::class);
        $this->parameters->setMaxGenerations($maxGenerations);
    }

    public function testUniqueDna()
    {
        $this->assertFalse($this->parameters->isUniqueDna());
        $this->parameters->setUniqueDna(true);
        $this->assertTrue($this->parameters->isUniqueDna());
    }

    public function testNegativeFit()
    {
        $this->assertFalse($this->parameters->isNegativeFit());
        $this->parameters->setNegativeFit(true);
        $this->assertTrue($this->parameters->isNegativeFit());
    }
}
