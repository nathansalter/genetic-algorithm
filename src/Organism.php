<?php
namespace GeneticAlgorithm;

/**
 * A simple organism for the genetic algorithm. This organism MUST accept an initial state in the constructor,
 * and recreate this state when it is __cloned().
 *
 * @package GeneticAlgorithm
 */
interface Organism
{
    /**
     * Get the DNA array for this Organism. Normally this would be a string, but we'd spend all our time doing
     * str_split and implode() on it all the time, so may as well keep it as an array
     *
     * Example: AAADDDAACCCDDD
     *      OR: ABFEGCD
     *
     * @return string[]
     */
    public function getDna(): array;

    /**
     * Return a value of fitness, how well this organism solves the problem.
     * Returns an INT with higher numbers indicating better fitness.
     *
     * OR
     *
     * Returns an INT with lower numbers indicating better fitness if set up in the parameters
     * 
     * @return int
     */
    public function fitness() : int;
}
