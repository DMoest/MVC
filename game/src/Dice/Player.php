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
class Player
{
    private int $credit;
    private ?int $wins = null;
    private array $results = [];
    private array $lastRoll = [];
    private object $lastHand;
    private ?int $sum;
    private ?float $average = null;
    private bool $stopped;
    private ?bool $bust = null;
    private ?bool $out = null;
    private bool $machine;

    /**
     * @method __construct()
     * @description Player class constructor method.
     * @param int $startCredit
     * @param bool $machinePlayer
     */
    final public function __construct(int $startCredit, bool $machinePlayer)
    {
        $this->credit = $startCredit;
        $this->results = [];
        $this->stopped = false;
        $this->bust = false;
        $this->out = false;
        $this->machine = $machinePlayer;
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
    final public function rollDices(int $dices = 1, int $faces = 6): array
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
     * @method getLastHand()
     * @description return last dice hand as object.
     * @return object
     */
    final public function getLastHand(): object
    {
        return $this->lastHand;
    }

    /**
     * @method getLastRollAsString()
     * @description returns string concat from all values in array lastRoll from last dice rolls.
     * @return string concatenation of integers from array of results.
     */
    final public function getLastRollAsString(): string
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
    final public function getAverage(): ?float
    {
        if (count($this->results) > 0) {
            $this->average = round(array_sum($this->results) / count($this->results), 2);
        }

        return $this->average;
    }

    /**
     * @method getCredit()
     * @description getter function to return players credit account.
     * @return int as value of player credit.
     */
    final public function getCredit(): int
    {
        return $this->credit;
    }

    /**
     * @method setCredit()
     * @description setter function to set new credit to player credit account.
     * @param int $newCredit as the credit to set.
     * @return void
     */
    final public function setCredit(int $newCredit): void
    {
        $this->credit = $newCredit;
    }

    /**
     * @method setWin
     * @description setter method that iterates the property wins +1.
     * @returns void
     */
    final public function setWin()
    {
        $this->wins++;
    }

    /**
     * @method getWins()
     * @description getter method that returns the integer value of the property wins.
     * @return int
     */
    final public function getWins(): ?int
    {
        return $this->wins;
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

    /**
     * @method isBust()
     * @description returns a boolean value to indicate if this player has gone bust in the current round.
     * @return bool
     */
    final public function isBust(): bool
    {
        return $this->bust;
    }

    /**
     * @method setBust()
     * @description Setter method to set boolean value when player is bust in current round.
     * @return void
     */
    final public function setBust()
    {
        $this->bust = true;
    }

    /**
     * @method isOut()
     * @description returns a boolean value to indicate if this player has gone bust in the current round.
     * @return bool
     */
    final public function isOut(): bool
    {
        return $this->out;
    }

    /**
     * @method setOut()
     * @description Setter method to set boolean value when player is bust in current round.
     * @return void
     */
    final public function setOut()
    {
        $this->out = true;
    }

    /**
     * @method isMachine()
     * @description returns boolean value to indicate if this player is run by computer/machine or not.
     * @return bool as indicator of machine player or not.
     */
    final public function isMachine(): bool
    {
        return $this->machine;
    }

    /**
     * @method setForNextRound()
     * @description setter method that setts up a player for next round of dice game.
     * @return void
     */
    final public function setForNextRound(): void
    {
        $this->stopped = false;
        $this->results = [];
        $this->lastRoll = [];
        $this->sum = null;
        $this->average = null;
        $this->bust = false;

        /* Check players credit */
        if ($this->credit === 0) {
            $this->stopped = true;
        }
    }
}
