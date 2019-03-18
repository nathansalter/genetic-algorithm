<?php
namespace GeneticAlgorithm;

final class Parameters
{
    /**
     * @var Organism
     */
    private $organismFactory;

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
     * @var bool Deny repeat chromosomes e.g. ABDE instead of AAABBBDDEEE
     */
    private $uniqueDna = false;

    /**
     * @var bool If target fit is negative
     */
    private $negativeFit = false;

    public function getOrganismFactory() : OrganismFactory
    {
        if(! $this->organismFactory instanceof OrganismFactory) {
            throw new \RuntimeException(sprintf('%s() Missing OrganismFactory', __METHOD__));
        }
        return $this->organismFactory;
    }

    public function setOrganismFactory(OrganismFactory $organismFactory): Parameters
    {
        $this->organismFactory = $organismFactory;
        return $this;
    }

    public function getPopulationSize() : int
    {
        if(null === $this->populationSize) {
            throw new \RuntimeException(sprintf('%s() Missing Population Size', __METHOD__));
        }
        return $this->populationSize;
    }

    public function setPopulationSize(int $populationSize): Parameters
    {
        if($populationSize <= 0) {
            throw new \InvalidArgumentException(sprintf('%s() only accepts Natural numbers, given %d', __METHOD__, $populationSize));
        }
        $this->populationSize = $populationSize;
        return $this;
    }

    public function getMutateRate() : float
    {
        if(null === $this->mutateRate) {
            throw new \RuntimeException(sprintf('%s() Missing Mutate rate', __METHOD__));
        }
        return $this->mutateRate;
    }

    public function setMutateRate(float $mutateRate): Parameters
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

    public function getBreedRate() : float
    {
        if(null === $this->breedRate) {
            throw new \RuntimeException(sprintf('%s() Missing Breed rate', __METHOD__));
        }
        return $this->breedRate;
    }

    public function setBreedRate(float $breedRate): Parameters
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

    public function hasFitnessGoal() : bool
    {
        return null !== $this->fitnessGoal;
    }

    public function getFitnessGoal() : int
    {
        if(!$this->hasFitnessGoal()) {
            throw new \RuntimeException(sprintf('%s() Missing Fitness goal', __METHOD__));
        }
        return $this->fitnessGoal;
    }

    public function setFitnessGoal(int $fitnessGoal): Parameters
    {
        $this->fitnessGoal = $fitnessGoal;
        return $this;
    }

    public function getMaxGenerations() : int
    {
        if(null === $this->maxGenerations) {
            throw new \RuntimeException(sprintf('%s() Missing Maximum generations', __METHOD__));
        }
        return $this->maxGenerations;
    }

    public function setMaxGenerations(int $maxGenerations): Parameters
    {
        if($maxGenerations <= 0) {
            throw new \InvalidArgumentException(sprintf('%s() only accepts Natural numbers, given %d', __METHOD__, $maxGenerations));
        }
        $this->maxGenerations = $maxGenerations;
        return $this;
    }

    public function isUniqueDna(): bool
    {
        return $this->uniqueDna;
    }

    public function setUniqueDna(bool $uniqueDna): Parameters
    {
        $this->uniqueDna = $uniqueDna;
        return $this;
    }

    public function isNegativeFit(): bool
    {
        return $this->negativeFit;
    }

    public function setNegativeFit(bool $negativeFit): Parameters
    {
        $this->negativeFit = $negativeFit;
        return $this;
    }
}
