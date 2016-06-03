<?php
namespace GeneticAlgorithm;

final class Parameters
{
    /**
     * @var Organism
     */
    private $organismPrototype;

    /**
     * @var int
     */
    private $populationSize;

    /**
     * @var float rate of mutation between 0 and 1
     */
    private $mutateRate;

    /**
     * @var float rate of breeding between 0 and 1
     */
    private $breedRate;

    /**
     * @var int minimum fitness before exiting
     */
    private $fitnessGoal;

    /**
     * @var int maximum iterations over the population before exiting
     */
    private $maxGenerations;

    /**
     * @return Organism
     */
    public function getOrganismPrototype() : Organism
    {
        return $this->organismPrototype;
    }

    /**
     * @param Organism $organismPrototype
     * @return Parameters
     */
    public function setOrganismPrototype(Organism $organismPrototype)
    {
        $this->organismPrototype = $organismPrototype;
        return $this;
    }

    /**
     * @return int
     */
    public function getPopulationSize() : int
    {
        return $this->populationSize;
    }

    /**
     * @param int $populationSize
     * @return Parameters
     */
    public function setPopulationSize(int $populationSize)
    {
        if($populationSize <= 0) {
            throw new \InvalidArgumentException(sprintf('%s() only accepts Natural numbers, given %d', __METHOD__, $populationSize));
        }
        $this->populationSize = $populationSize;
        return $this;
    }

    /**
     * @return float
     */
    public function getMutateRate() : float
    {
        return $this->mutateRate;
    }

    /**
     * @param float $mutateRate
     * @return Parameters
     */
    public function setMutateRate(float $mutateRate)
    {
        if($mutateRate < 0 || $mutateRate > 1) {
            throw new \InvalidArgumentException(sprintf(
                '%s() only accepts Rational numbers between 0 and 1 (inclusive), given %01.5f',
                __METHOD__,
                $mutateRate
            ));
        }
        $this->mutateRate = $mutateRate;
        return $this;
    }

    /**
     * @return float
     */
    public function getBreedRate() : float
    {
        return $this->breedRate;
    }

    /**
     * @param float $breedRate
     * @return Parameters
     */
    public function setBreedRate(float $breedRate)
    {
        if($breedRate < 0 || $breedRate > 1) {
            throw new \InvalidArgumentException(sprintf(
                '%s() only accepts Rational numbers between 0 and 1 (inclusive), given %01.5f',
                __METHOD__,
                $breedRate
            ));
        }
        $this->breedRate = $breedRate;
        return $this;
    }

    /**
     * @return int
     */
    public function getFitnessGoal() : int
    {
        return $this->fitnessGoal;
    }

    /**
     * @param int $fitnessGoal
     * @return Parameters
     */
    public function setFitnessGoal(int $fitnessGoal)
    {
        $this->fitnessGoal = $fitnessGoal;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxGenerations() : int
    {
        return $this->maxGenerations;
    }

    /**
     * @param int $maxGenerations
     * @return Parameters
     */
    public function setMaxGenerations(int $maxGenerations)
    {
        if($maxGenerations <= 0) {
            throw new \InvalidArgumentException(sprintf('%s() only accepts Natural numbers, given %d', __METHOD__, $maxGenerations));
        }
        $this->maxGenerations = $maxGenerations;
        return $this;
    }
}
