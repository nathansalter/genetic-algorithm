<?php
namespace GeneticAlgorithm;

use Exception;

class UnfitException extends \Exception
{
    /**
     * @var Organism
     */
    private $bestFit;

    public function __construct($message, $code, Exception $previous, Organism $bestFit)
    {
        parent::__construct($message, $code, $previous);
        $this->setBestFit($bestFit);
    }

    /**
     * @return Organism
     */
    public function getBestFit() : Organism
    {
        return $this->bestFit;
    }

    /**
     * @param Organism $bestFit
     * @return UnfitException
     */
    public function setBestFit(Organism $bestFit)
    {
        $this->bestFit = $bestFit;
        return $this;
    }
}
