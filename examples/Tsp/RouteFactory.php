<?php

namespace GeneticAlgorithmExamples\Tsp;

use GeneticAlgorithm\Organism;
use GeneticAlgorithm\OrganismFactory;

class RouteFactory implements OrganismFactory
{
    /** @var Node[] */
    private $nodes;

    public function __construct(array $nodes)
    {
        $this->nodes = array_combine(
            array_map(function (Node $node) { return $node->getName();}, $nodes),
            array_map(function (Node $node) { return $node;}, $nodes)
        );
    }

    public function createFromDna(array $dna): Organism
    {
        $route = [];
        $firstDna = $currentDna = array_shift($dna);
        // Create the route
        foreach ($dna as $nodeName) {
            $route[] = new Link(
                $this->nodes[$currentDna],
                $this->nodes[$nodeName]
            );
            $currentDna = $nodeName;
        }
        // Return to the start
        $route[] = new Link(
            $this->nodes[$currentDna],
            $this->nodes[$firstDna]
        );

        return new Route(...$route);
    }
}