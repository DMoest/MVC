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
    protected array $results = [];
    protected array $lastRoll = [];
    protected object $lastHand;
    protected ?int $sum;
    protected ?float $average = null;


    /**
     * @method __construct()
     * @description YatzyPlayer class constructor method.
     * @param bool $machinePlayer
     */
    public function __construct()
    {
        $this->average = $this->getAverage();
        $this->sum = 0;
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
        $dices = count($values);

        for ($i = 0; $i < $dices; $i++) {
            $this->lastRoll[] = $values[$i];
            $this->results[] = $values[$i];
        }

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
     * @method getResultsAsString()
     * @description returns string concat from all values in array of results from dice rolls.
     * @return string concatenation of integers from array of results.
     */
    public function getResultsAsString(): string
    {
        $output = "";
        $dices = count($this->results);

        for ($i = 0; $i < $dices; $i++) {
            if ($i < count($this->results) -1) {
                $output .= $this->results[$i] . ", ";
            } else if ($i == count($this->results) -1) {
                $output .= $this->results[$i] . " = " . array_sum($this->results);
            }
        }

        return $output;
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
     * @method getLastRollAsString()
     * @description returns string concat from all values in array lastRoll from last dice rolls.
     * @return string concatenation of integers from array of results.
     */
    public function getLastRollAsString(): string
    {
        $output = "";
        $dices = count($this->lastRoll);

        for ($i = 0; $i < $dices; $i++) {
            if ($i < count($this->lastRoll) -1) {
                $output .= $this->lastRoll[$i] . ", ";
            } else if ($i == count($this->lastRoll) -1) {
                $output .= $this->lastRoll[$i] . " = " . array_sum($this->lastRoll);
            }
        }

        return $output;
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
