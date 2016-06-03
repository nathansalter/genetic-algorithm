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
     */
    public function __construct(Parameters $parameters)
    {
        $this->parameters = $parameters;
        $this->population = [];
        for($n = 0; $n < $parameters->getPopulationSize(); $n++) {
            $this->population[] = clone $this->parameters->getOrganismPrototype();
        }
    }
    
    public function solve() : Organism
    {
        for($n = 0; $n < $this->parameters->getMaxGenerations(); $n++) {
            // Calculate the next iteration of the population
            foreach($this->population as $organism) {
                if(mt_rand(0, self::BREED_GRANULARITY) < $this->parameters->getBreedRate() * self::BREED_GRANULARITY) {
                    $mate = $this->population[mt_rand(0, $this->parameters->getPopulationSize())];
                    $this->population[] = $organism->breed($mate);
                }
                if(mt_rand(0, self::MUTATE_GRANULARITY) < $this->parameters->getMutateRate() * self::MUTATE_GRANULARITY) {
                    $organism->mutate();
                }
            }
            // Check to see if the most fit member of the population meets the fitness criteria
            $bestFit = $this->getBestFit();
            if($bestFit->fitness() >= $this->parameters->getFitnessGoal()) {
                return $bestFit;
            }
            // Discard the least fit
            $this->sortPopulation();
            $this->population = array_slice($this->population, 0, $this->parameters->getPopulationSize());
        }
        // Just return the best result we could find
        return $this->getBestFit();
    }

    private function sortPopulation()
    {
        // Order the organisms by fitness descending
        usort($this->population, function(Organism $organismA, Organism $organismB) {
            return $organismB <=> $organismA;
        });
    }

    private function getBestFit() : Organism
    {
        $this->sortPopulation();
        return reset($this->population);
    }
}
