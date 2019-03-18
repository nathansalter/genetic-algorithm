<?php
namespace GeneticAlgorithm;

/**
 * A Factory class to create Organisms when given a DNA string.
 *
 * @package GeneticAlgorithm
 */
interface OrganismFactory
{
    /**
     * Create a new organism from a DNA string of this organism Type
     *
     * @param array $dna
     * @return Organism
     */
    public function createFromDna(array $dna): Organism;
}
