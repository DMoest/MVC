<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;

/**
 * Functions in use.
 */
//use function Mos\Functions\{
//    destroySession,
//    redirectTo,
//    renderView,
//    renderTwigView,
//    sendResponse,
//    url
//};

/**
 * Include files:
 * Configuration file.
 */
include(__DIR__ . "/../../config/config.php");

/**
 * @name Player
 * @package Daap19\Dice
 */
class Player implements PlayerInterface
{
    use ResultsAsStringTrait;

    protected array $results = [];
    protected array $lastRoll = [];
    protected ?object $lastHand;
    protected ?int $sum = null;
    protected ?float $average = null;
    protected int $faces = 6;
    protected int $dices = 1;


    /**
     * @method __construct()
     * @description YatzyPlayer class constructor method.
     * @param bool $machinePlayer
     */
    public function __construct()
    {
        $this->sum = 0;
        $this->average = 0;
    }


    /**
     * @method rollDices()
     * @description creates a new object from class DiceHand and rolls the hand of dices.
     * @param int $dices as number of dices in hand.
     * @param int $faces as number of faces on the dices in the hand.
     * @return array of integers as values from dice hand roll.
     */
    public function rollDices(int $dices = 1, int $faces = 6): array
    {
        $diceHand = new DiceHand($dices, $faces);
        $diceHand->roll();
        $values = $diceHand->getLastRoll();
        $this->lastHand = $diceHand; // last diceHand as object
        $this->lastRoll = []; // clear values
//        $dices = count($values);

        foreach ($values as $key => $dice) {
            $this->lastRoll[$key] = $dice;
            $this->results[] = $dice;
        }
//        for ($i = 0; $i < $dices; $i++) {
//            $this->lastRoll[] = $values[$i];
//            $this->results[] = $values[$i];
//        }

        return $values;
    }


    /**
     * @method getResults()
     * @description returns results as array of integers representing values from rolling dices.
     * @return array of integers
     */
    public function getResults(): array
    {
        return $this->results;
    }


    /**
     * @method getSumTotal()
     * @description setter/getter method combined that returns the sum total of all result values from the property array results.
     * @return int as total value of array results.
     */
    public function getSumTotal(): int
    {
        /* Set sum total */
        $this->sum = array_sum($this->results);

        /* Get sum total */
        return $this->sum;
    }


    /**
     * @method getLastRoll()
     * @description returns array of values from last dice hand roll.
     * @return array of integers as values.
     */
    public function getLastRoll(): array
    {
        return $this->lastRoll;
    }


    /**
     * @method getLastHand()
     * @description return last dice hand as object.
     * @return object
     */
    public function getLastHand(): object
    {
        return $this->lastHand;
    }


    /**
     * @method getAverage()
     * @description setter/getter method combined that returns the average float|integer value of values in array of results.
     * @return float|null as a calculated average value from results.
     */
    public function getAverage(): ?float
    {
        if (count($this->results) > 0) {
            $this->average = round(array_sum($this->results) / count($this->results), 2);
        }

        return $this->average;
    }

}
