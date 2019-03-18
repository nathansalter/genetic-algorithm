<?php

/**
 * Sample implementation of the travelling salesman problem
 */

use GeneticAlgorithm\Parameters;
use GeneticAlgorithm\Population;
use GeneticAlgorithmExamples\Tsp\Node;
use GeneticAlgorithmExamples\Tsp\NodeLink;
use GeneticAlgorithmExamples\Tsp\Route;
use GeneticAlgorithmExamples\Tsp\RouteFactory;

require_once __DIR__ . '/../vendor/autoload.php';

// Create Nodes
$nodes = [];
$initialDna = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M'];
foreach ($initialDna as $name) {
    $nodes[] = new Node($name);
}

// Fully connect all nodes
foreach ($nodes as $nodeA) {
    $nodeLinks = [];
    foreach ($nodes as $nodeB) {
        $link = new NodeLink($nodeA, $nodeB, mt_rand(1, 10));
        $nodeLinks[] = $link;
    }

    $nodeA->setLinks(...$nodeLinks);
}

$factory = new RouteFactory($nodes);

$parameters = new Parameters();
$parameters->setBreedRate(0.01)
    ->setMutateRate(0.001)
    ->setMaxGenerations(1000)
    ->setPopulationSize(100)
    ->setOrganismFactory($factory)
    ->setNegativeFit(true)
    ->setUniqueDna(true);

printf('Initial Route:%s', PHP_EOL);

/** @var Route $adam */
$adam = $factory->createFromDna($initialDna);
foreach ($adam->getRoute() as $link) {
    printf('%s -- %d -- %s%s', $link->getStartNode()->getName(), $link->getDistance(), $link->getEndNode()->getName(), PHP_EOL);
}
printf('Total distance: %s%s', $adam->fitness(), PHP_EOL);

$population = new Population($parameters, $initialDna);

/** @var Route $bestRoute */
$bestRoute = $population->solve();

printf('Best Route:%s', PHP_EOL);
foreach ($bestRoute->getRoute() as $link) {
    printf('%s -- %d -- %s%s', $link->getStartNode()->getName(), $link->getDistance(), $link->getEndNode()->getName(), PHP_EOL);
}
printf('Total distance: %s%s', $bestRoute->fitness(), PHP_EOL);