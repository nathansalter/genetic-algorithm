<?php
namespace GeneticAlgorithm;

final class Population
{
    const BREED_GRANULARITY = 10000;

    const MUTATE_GRANULARITY = 10000;

    /**
     * @var Parameters
     */
    private $parameters;

    /**
     * @var Organism[]
     */
    private $population;

    /**
     * Build a population 
     * @param Parameters $parameters
     * @param array $dna
     */
    public function __construct(Parameters $parameters, array $dna)
    {
        $this->parameters = $parameters;
        $this->population = [];
        for($n = 0; $n < $parameters->getPopulationSize(); $n++) {
            $this->population[] = $this->parameters->getOrganismFactory()->createFromDna($dna);
            shuffle($dna);
        }
    }
    
    public function solve() : Organism
    {
        for($n = 0; $n < $this->parameters->getMaxGenerations(); $n++) {
            // Calculate the next iteration of the population
            foreach($this->population as $k => $organism) {
                if(mt_rand(0, self::BREED_GRANULARITY) < $this->parameters->getBreedRate() * self::BREED_GRANULARITY) {
                    $mate = $this->population[mt_rand(0, $this->parameters->getPopulationSize() - 1)];
                    $this->population[] = $this->breed($organism, $mate);
                }
                if(mt_rand(0, self::MUTATE_GRANULARITY) < $this->parameters->getMutateRate() * self::MUTATE_GRANULARITY) {
                    $this->population[$k] = $this->mutate($organism);
                }
            }
            if($this->parameters->hasFitnessGoal()) {
                // Check to see if the most fit member of the population meets the fitness criteria
                $bestFit = $this->getBestFit();
                if ($bestFit->fitness() >= $this->parameters->getFitnessGoal()) {
                    return $bestFit;
                }
            }
            // Discard the least fit
            $this->sortPopulation();
            $this->population = array_slice($this->population, 0, $this->parameters->getPopulationSize());
        }
        // Just return the best result we could find
        return $this->getBestFit();
    }

    private function breed(Organism $a, Organism $b): Organism
    {
        $dnaA = $a->getDna();
        $dnaB = $b->getDna();

        $splicePoint = mt_rand(0, count($dnaA) - 1);

        $append = $dnaB[$splicePoint];
        $dnaB[$splicePoint] = $dnaA[$splicePoint];

        if ($this->parameters->isUniqueDna()) {
            $dnaB[] = $append;
            $dnaB = array_unique($dnaB);
        }

        return $this->parameters->getOrganismFactory()->createFromDna($dnaB);
    }

    private function mutate(Organism $a): Organism
    {
        $dna = $a->getDna();

        $splicePointA = mt_rand(0, count($dna) - 1);
        $splicePointB = mt_rand(0, count($dna) - 1);

        $dna[$splicePointA] = $a->getDna()[$splicePointB];
        $dna[$splicePointB] = $a->getDna()[$splicePointA];

        return $this->parameters->getOrganismFactory()->createFromDna($dna);
    }

    private function sortPopulation()
    {
        // Order the organisms by fitness descending
        usort($this->population, function(Organism $organismA, Organism $organismB) {
            if ($this->parameters->isNegativeFit()) {
                return $organismA->fitness() <=> $organismB->fitness();
            } else {
                return $organismB->fitness() <=> $organismA->fitness();
            }
        });
    }

    private function getBestFit() : Organism
    {
        $this->sortPopulation();
        return reset($this->population);
    }
}
