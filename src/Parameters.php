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
        if(! $this->organismPrototype instanceof Organism) {
            throw new \RuntimeException(sprintf('%s() Missing Organism', __METHOD__));
        }
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
        if(null === $this->populationSize) {
            throw new \RuntimeException(sprintf('%s() Missing Population Size', __METHOD__));
        }
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
        if(null === $this->mutateRate) {
            throw new \RuntimeException(sprintf('%s() Missing Mutate rate', __METHOD__));
        }
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
        if(null === $this->breedRate) {
            throw new \RuntimeException(sprintf('%s() Missing Breed rate', __METHOD__));
        }
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
     * @return bool
     */
    public function hasFitnessGoal() : bool
    {
        return null !== $this->fitnessGoal;
    }

    /**
     * @return int
     */
    public function getFitnessGoal() : int
    {
        if(!$this->hasFitnessGoal()) {
            throw new \RuntimeException(sprintf('%s() Missing Fitness goal', __METHOD__));
        }
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
        if(null === $this->maxGenerations) {
            throw new \RuntimeException(sprintf('%s() Missing Maximum generations', __METHOD__));
        }
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
