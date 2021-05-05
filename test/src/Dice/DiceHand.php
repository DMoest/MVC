<?php
/**
 * Dice testing.
 */

/**
 * Namespace.
 */
namespace Dicersice\Dice;

/**
 * Class DiceHand
 * @package Dicersice\DiceHand
 */
class DiceHand
{
    private ?int $faces = null;
    private array $dices = [];
    private ?int $numberOfDices = null;
    private array $results = [];

    /**
     * DiceHand constructor.
     * @param int $faces as faces of the dices to be rolled/thrown.
     * @param int $rolls as number of dices to throw.
     */
    public function __construct(int $dicesInHand = 1, int $faces = 6)
    {
        $this->numberOfDices = $dicesInHand;
        $this->faces = $faces;

        for ($i = 0; $i < $dicesInHand; $i++) {
            $this->dices[] = new Dice($faces);
            $this->results[] = null;
        }
    }

    /**
     * DiceHand destructor.
     */
//    public function __destruct()
//    {
//        echo __METHOD__;
//    }

    /**
     * @return array as the results of all the dice rolls/throws.
     */
    public function rollDices(): array
    {
        for($i = 0; $i < count($this->dices); $i++)
        {
            $this->dices[$i]->roll();
            array_splice($this->results, $i, 1, $this->dices[$i]->getLastRoll());
        }

        return $this->results;
    }

    /**
     * @name getDices
     * @description getter method that returns the array that holds all the dices in the dice hand.
     * @return array as all the dice objects.
     */
    public function getDices(): array
    {
        return $this->dices;
    }

    /**
     * @name getResults
     * @description getter method that returns the array containing all the results of the dice hand throw.
     * @return array as all the results of the dices thrown.
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @name getSum
     * @description getter method that returns integer value as sum of all the dices rolled/thrown i hand.
     * @return int as sum of values from dices.
     */
    public function getSum(): int
    {
        return array_sum($this->results);
    }

    /**
     * @name getAverage
     * @description getter method that returns the average float|integer value of dice hand results.
     * @return float|null
     */
    public function getAverage(): ?float
    {
        return round(array_sum($this->results) / count($this->results), 2);
    }
}
