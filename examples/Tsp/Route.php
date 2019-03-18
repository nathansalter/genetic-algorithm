<?php

namespace GeneticAlgorithmExamples\Tsp;

use GeneticAlgorithm\Organism;

class Route implements Organism
{
    /** @var Link[] */
    private $route;

    public function __construct(Link... $route)
    {
        $this->route = $route;
    }

    /**
     * @return Link[]
     */
    public function getRoute(): array
    {
        return array_map(function (Link $link) { return clone $link; }, $this->route);
    }

    public function getDna(): array
    {
        return array_map(function (Link $link) {
            return $link->getStartNode()->getName();
        }, $this->route);
    }

    public function __clone()
    {
        $this->route = array_map(function (Link $link) { return clone $link; }, $this->route);
    }

    public function fitness() : int
    {
        $fitness = 0;
        foreach ($this->route as $link) {
            $fitness += $link->getDistance();
        }
        return $fitness;
    }
}