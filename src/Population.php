<?php
namespace GeneticAlgorithm;

class Population
{
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
            $this->population[$n] = clone $this->parameters->getOrganismPrototype();
        }
    }
    
    public function solve() : Organism
    {
        for($n = 0; $n < $this->parameters->getMaxGenerations(); $n++) {
            $this->sortPopulation();
            // Calculate the next iteration of the population
        }
        // Check to see if the most fit member of the population meets the fitness criteria
        $bestFit = $this->getBestFit();
        if($bestFit->fitness() >= $this->parameters->getFitnessGoal()) {
            return $bestFit;
        }
        // We have no organism which meets the fitness goal
        throw new UnfitException('No fit organism', null, null, $bestFit);
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
