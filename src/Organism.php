<?php
namespace GeneticAlgorithm;

/**
 * A simple organism for the genetic algorithm. This organism MUST provide itself with an initial state,
 * and recreate this state when it is __cloned().
 *
 * @package GeneticAlgorithm
 */
interface Organism
{
    /**
     * Changes the state of this organism in a random fashion
     * 
     * @return void
     */
    public function mutate();

    /**
     * Breeds this organism with a mate, returns the new organism. Note; this
     * organism MAY be itself
     * 
     * @param Organism $mate
     * @return Organism
     */
    public function breed(Organism $mate) : Organism;

    /**
     * Return a value of fitness, how well this organism solves the problem.
     * Returns an INT with higher numbers indicating better fitness.
     * 
     * @return int
     */
    public function fitness() : int;
}
