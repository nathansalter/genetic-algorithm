<?php

namespace GeneticAlgorithmExamples\Tsp;

class Link
{
    /** @var Node */
    private $nodeStart;

    /** @var Node */
    private $nodeEnd;

    /** @var int */
    private $distance;

    public function __construct(Node $start, Node $end)
    {
        $this->nodeStart = $start;
        $this->nodeEnd = $end;
        $this->calculateDistance();
    }

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function setStartNode(Node $node)
    {
        $this->nodeStart = $node;
        $this->calculateDistance();
    }

    public function getStartNode(): Node
    {
        return $this->nodeStart;
    }

    public function setEndNode(Node $node)
    {
        $this->nodeEnd = $node;
        $this->calculateDistance();
    }

    public function getEndNode(): Node
    {
        return $this->nodeEnd;
    }

    private function calculateDistance()
    {
        foreach ($this->nodeStart->getLinks() as $link) {
            if ($link->getEndNode() === $this->nodeEnd) {
                $this->distance = $link->getDistance();
                return;
            }
        }
        throw new \RuntimeException(sprintf(
            'Graph not fully connected. Node %s not connected to Node %s',
            $this->nodeStart->getName(),
            $this->nodeEnd->getName()
        ));
    }
}