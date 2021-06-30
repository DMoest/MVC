<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Yatzy;
use daap19\Dice\DiceHand;
use daap19\Dice\Player;
use daap19\Dice\PlayerInterface;

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
 * @name YatzyPlayer
 * @package Daap19\Dice
 */
class YatzyPlayer extends Player implements PlayerInterface, YatzyPlayerInterface
{
    private ?int $rolls;
    private ?object $diceHand;
    private ?array $keepDices;
    private bool $stopped;


    /**
     * @method __construct()
     * @description YatzyPlayer class constructor method.
     */
    final public function __construct()
    {
        parent::__construct(); // construct from parent class.

        $this->rolls = 0;
        $this->results = [];
        $this->keep = [];
        $this->diceHand = null;
        $this->lastHand = null;
        $this->lastRoll = [];
        $this->keepDices = [];
        $this->average = $this->getAverage();
        $this->sum = $this->getScore();
    }


    /**
     * @method rollDices()
     * @description creates a new object from class DiceHand and rolls the hand of dices.
     * @param int $dices as number of dices in hand.
     * @param int $faces as number of faces on the dices in the hand.
     * @return array of integers as values from dice hand roll.
     */
    final public function rollDices(int $dices = 5, int $faces = 6): array
    {
        if (!isset($diceHand)) {
            $diceHand = new DiceHand($dices, $faces);

        }
        $this->lastRoll = $diceHand->roll();
        $this->diceHand = $diceHand;
        $this->results = $diceHand->getLastRoll();
        $dices = $diceHand->getDices();
        $numOfDices = count($dices);
        $this->results = []; // Clear array of results.

        for ($i = 0; $i < $numOfDices; $i++) {
            $this->results[] = $this->lastRoll[$i];
        }

        return $this->lastRoll;
    }


    /**
     * @method getRolls()
     * @description Getter method to return number of rolls player done this current round.
     * @return int as number of rolls player done.
     */
    final public function getRolls(): int
    {
        return $this->rolls;
    }


    /**
     * @method getScore()
     * @description returns a sum of all values in array of results.
     * @return int as player score.
     */
    final public function getScore(): int
    {
        return array_sum($this->results);
    }


    /**
     * @method getResults()
     * @description returns results as array of integers representing values from rolling dices.
     * @return array of integers
     */
    final public function getResults(): array
    {
        return $this->results;
    }


    /**
     * @method getSumTotal()
     * @description setter/getter method combined that returns the sum total of all result values from the property array results.
     * @return int as total value of array results.
     */
    final public function getSumTotal(): int
    {
        /* Set sum total */
        $this->sum = array_sum($this->results);

        /* Get sum total */
        return $this->sum;
    }


    /**
     * @method getResultsAsString()
     * @description returns string concat from all values in array of results from dice rolls.
     * @return string concatenation of integers from array of results.
     */
    final public function getResultsAsString(): string
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
     * @method getLastRoll()
     * @description returns array of values from last dice hand roll.
     * @return array of integers as values.
     */
    final public function getLastRoll(): array
    {
        return $this->lastRoll;
    }


    /**
     * @method getDiceHand()
     * @description return last dice hand as object.
     * @return ?object
     */
    final public function getDiceHand(): ?object
    {
        return $this->diceHand;
    }


    /**
     * @method keepDices()
     * @description Stores index numbers of dices in diceHand. These dices are not to be rolled in next diceHand roll.
     * @param array $diceIndexes as integers of index numbers for dices.
     * @returns array of integers.
     */
    final public function keepDices(array $diceIndexes): array
    {
        $this->keep = []; // Clear old values if any.
        $dices = $this->diceHand->getDices();

        foreach ($diceIndexes as $index) {
            $this->keep[$index] = $dices[$index];
        }

        return $this->keep;
    }



    /**
     * @method stop()
     * @description setter method to set boolean property to indicate that player have stopped at this score.
     * @return void
     */
    final public function stop(): void
    {
        $this->stopped = true;
    }


    /**
     * @method hasStopped()
     * @description getter method that returns a boolean value to indiate if player have stopped or not.
     * @return bool as indicator if player have stopped.
     */
    final public function hasStopped(): bool
    {
        return $this->stopped;
    }
}
