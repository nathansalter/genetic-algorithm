<?php

namespace GeneticAlgorithm;

use PHPUnit\Framework\TestCase;

class PopulationTest extends TestCase
{
    public function testSolvesGeneticAlgorithm()
    {
        $unfit = $this->createMock(Organism::class);
        $unfit->expects($this->atLeast(10))
            ->method('fitness')
            ->willReturn(10);

        $fit = $this->createMock(Organism::class);
        $fit->expects($this->atLeast(1))
            ->method('fitness')
            ->willReturn(100);

        $factory = $this->createMock(OrganismFactory::class);
        $factory->expects($this->exactly(10))
            ->method('createFromDna')
            ->willReturnOnConsecutiveCalls(
                $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit,
                $fit
            );

        $parameters = new Parameters();
        $parameters->setPopulationSize(10)
            ->setMaxGenerations(2)
            ->setBreedRate(0)
            ->setMutateRate(0)
            ->setOrganismFactory($factory);

        $population = new Population($parameters, ['A', 'B', 'C']);
        $solvedOrganism = $population->solve();

        $this->assertSame($fit, $solvedOrganism);
    }

    public function testBreedsOrganisms()
    {
        $unfit = $this->createMock(Organism::class);
        $unfit->expects($this->atLeastOnce())
            ->method('getDna')
            ->willReturn(['A', 'B', 'C']);
        $unfit->expects($this->atLeast(1))
            ->method('fitness')
            ->willReturn(10);

        $fit = $this->createMock(Organism::class);
        $fit->expects($this->atLeastOnce())
            ->method('getDna')
            ->willReturn(['B', 'C', 'A']);
        $fit->expects($this->atLeastOnce())
            ->method('fitness')
            ->willReturn(100);

        $factory = $this->createMock(OrganismFactory::class);
        $factory->expects($this->atLeast(2))
            ->method('createFromDna')
            ->willReturnCallback(function (array $dna) use ($fit, $unfit) {
                if (['A', 'B', 'C'] != $dna) {
                    return $fit;
                } else {
                    return $unfit;
                }
            });

        $parameters = new Parameters();
        $parameters->setPopulationSize(2)
            ->setMaxGenerations(1)
            ->setBreedRate(1)
            ->setMutateRate(0)
            ->setOrganismFactory($factory);

        $population = new Population($parameters, ['A', 'B', 'C']);
        $solvedOrganism = $population->solve();

        $this->assertSame($fit, $solvedOrganism);
    }

    public function testMutatesOrganisms()
    {
        $unfit = $this->createMock(Organism::class);
        $unfit->expects($this->atLeastOnce())
            ->method('getDna')
            ->willReturn(['A', 'B', 'C', 'D']);
        $unfit->method('fitness')
            ->willReturn(10);

        $fit = $this->createMock(Organism::class);
        $fit->method('getDna')
            ->willReturn(['B', 'C', 'A', 'D']);
        $fit->method('fitness')
            ->willReturn(100);

        $factory = $this->createMock(OrganismFactory::class);
        $factory->expects($this->atLeast(2))
            ->method('createFromDna')
            ->willReturnCallback(function (array $dna) use ($fit, $unfit) {
                if (['A', 'B', 'C'] != $dna) {
                    return $fit;
                } else {
                    return $unfit;
                }
            });

        $parameters = new Parameters();
        $parameters->setPopulationSize(2)
            ->setMaxGenerations(1)
            ->setBreedRate(0)
            ->setMutateRate(1)
            ->setOrganismFactory($factory);

        $population = new Population($parameters, ['A', 'B', 'C']);
        $solvedOrganism = $population->solve();

        $this->assertSame($fit, $solvedOrganism);
    }

    public function testSolvesWithNegativeFit()
    {
        $unfit = $this->createMock(Organism::class);
        $unfit->expects($this->atLeast(10))
            ->method('fitness')
            ->willReturn(100);

        $fit = $this->createMock(Organism::class);
        $fit->expects($this->atLeast(1))
            ->method('fitness')
            ->willReturn(10);

        $factory = $this->createMock(OrganismFactory::class);
        $factory->expects($this->exactly(10))
            ->method('createFromDna')
            ->willReturnOnConsecutiveCalls(
                $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit,
                $fit
            );

        $parameters = new Parameters();
        $parameters->setPopulationSize(10)
            ->setMaxGenerations(2)
            ->setBreedRate(0)
            ->setMutateRate(0)
            ->setOrganismFactory($factory)
            ->setNegativeFit(true);

        $population = new Population($parameters, ['A', 'B', 'C']);
        $solvedOrganism = $population->solve();

        $this->assertSame($fit, $solvedOrganism);
    }

    public function testSolvesWithUniqueDna()
    {
        $unfit = $this->createMock(Organism::class);
        $unfit->expects($this->atLeast(10))
            ->method('fitness')
            ->willReturn(10);

        $fit = $this->createMock(Organism::class);
        $fit->expects($this->atLeast(1))
            ->method('fitness')
            ->willReturn(100);

        $factory = $this->createMock(OrganismFactory::class);
        $factory->expects($this->exactly(10))
            ->method('createFromDna')
            ->willReturnOnConsecutiveCalls(
                $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit, $unfit,
                $fit
            );

        $parameters = new Parameters();
        $parameters->setPopulationSize(10)
            ->setMaxGenerations(2)
            ->setBreedRate(0)
            ->setMutateRate(0)
            ->setOrganismFactory($factory)
            ->setUniqueDna(true);

        $population = new Population($parameters, ['A', 'B', 'C']);
        $solvedOrganism = $population->solve();

        $this->assertSame($fit, $solvedOrganism);
    }
}
