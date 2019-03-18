<?php

namespace GeneticAlgorithmExamples\Tsp;

class Node
{
    /** @var string */
    private $name;

    /** @var NodeLink[] */
    private $links;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setLinks(NodeLink... $links)
    {
        $this->links = array_map(function (NodeLink $link) { return clone $link; }, $links);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return NodeLink[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    public function __clone()
    {
        throw new \RuntimeException('Nodes MUST not be cloned.');
    }
}