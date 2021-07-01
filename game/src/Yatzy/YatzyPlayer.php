<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Yatzy;
use daap19\Dice\Player;
use daap19\Dice\ResultsAsStringTrait;
use daap19\Dice\LastRollAsStringTrait;

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
class YatzyPlayer extends Player implements YatzyPlayerInterface
{
    use LastRollAsStringTrait;
    use ResultsAsStringTrait;

    private ?int $rolls;
    private ?object $diceHand;
    private ?array $keepDices;
    private bool $stopped;
    private array $playerScores = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];


    /**
     * @method __construct()
     * @description YatzyPlayer class constructor method.
     */
    final public function __construct()
    {
        parent::__construct(); // construct from parent class.

        $this->rolls = 0;
        $this->results = [];
        $this->lastRoll = [];
        $this->diceHand = new YatzyDiceHand(5, 6);
        $this->lastHand = null;
        $this->keepDices = $this->diceHand->getKeptDices();
        $this->sum = $this->getScore();
        $this->average = $this->getAverage();
    }


    /**
     * @method rollDices()
     * @description creates a new object from class DiceHand and rolls the hand of dices.
     * @return array of integers as values from dice hand roll.
     */
    final public function rollDices(int $dices = 5, int $faces = 6): array
    {
        $this->diceHand->roll();
        $this->lastRoll = $this->diceHand->getLastRoll();

        foreach ($this->lastRoll as $value) {
            $this->results[] = $value;
        }

        $this->rolls++;

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
        return array_sum($this->lastRoll);
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
        $score = $this->getScore();

        if ($score !== 0) {
            return $this->diceHand;
        }

        return null;
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


    /**
     * @method validateScoreValues()
     * @description Method to validate if all chosen values are the same & correct values.
     * @param array $chosenScores as the values player has chosen.
     * @param int $valueToBe as the value it is supposed to be/compared with.
     * @return bool|null as indicator of validity.
     */
    public function validateScoreValues(array $chosenScores, int $valueToBe): ?bool
    {
        $validity = null;

        foreach ($chosenScores as $value) {
            /* Check if valuse are the same */
            if ($value === $valueToBe) {
                $validity = true;
            } elseif ($value !== $valueToBe) {
                return false;
            }
        }

        return $validity;
    }


    /**
     * @method saveScores()
     * @description Takes dice values the player has chosen and saves the
     * @param array $theChosenScores
     * @param int $theValue
     * @return array|int[]
     */
    public function saveScores(array $theChosenScores, int $theValue): array
    {
        $this->playerScores[$theValue] + array_sum($theChosenScores);

        return $this->playerScores;
    }


    final public function setReadyForNextRound()
    {
        $this->rolls = 0;
        $this->lastRoll = [];
        $this->stopped = false;
    }
}
