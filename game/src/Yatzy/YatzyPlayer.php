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
    use ResultsAsStringTrait;

    private ?int $rolls;
    private ?object $diceHand;
    private ?array $keepDices;
    private bool $stopped;
    private array $playerScores = [];


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
        $this->playerScores = [0 => null, 1 => null, 2 => null, 3 => null, 4 => null, 5 => null];
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
     * @method getPlayerScore()
     * @description Getter method to return array of players saved dice scores so far.
     * @return array
     */
    final public function getPlayerScore(): array
    {
        return $this->playerScores;
    }


    /**
     * @method getAmountOfScoresSaved()
     * @description Getter method for counting number of saved scores.
     * @return int
     */
    final public function getAmountOfScoresSaved(): int
    {
        $countScores = 0;

        foreach ($this->playerScores as $scoreValue) {
            if ($scoreValue !== null) {
                $countScores++;
            }
        }

        return $countScores;
    }


    /**
     * @method getPlayerScoreSum()
     * @description Getter method to return the value of all scores in the array on the property $this->playerScore.
     * @return int as sum value of array $this->playerScore
     */
    final public function getPlayerScoreSum(): int
    {
        return array_sum($this->playerScores);
    }


    /**
     * @method getDiceHand()
     * @description return last dice hand as object.
     * @return ?object
     */
    final public function getDiceHand(): object
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


    /**
     * @method saveScores()
     * @description Takes dice values the player has chosen and saves the
     * @param array $chosenScores
     * @param int $referenceValue
     * @return void
     */
    public function saveScores(array $diceHandArray, int $referenceValue): void
    {
        $counter = 0;
        $scoreIndex = $referenceValue -1;

        /* Check the dice hand of the player for equal */
        foreach ($diceHandArray as $diceValue) {
            if ($diceValue === $referenceValue) {
                $counter++;
            }
        }

        /* Place a integer as score on the position chosen by the player */
        if ($counter > 0) {
            $this->playerScores[$scoreIndex] = ($counter * $referenceValue);
        } elseif ($counter === 0) {
            $this->playerScores[$scoreIndex] = 0;
        }
    }


    /**
     * @method setForNextRound()
     * @description Setter method to prepare yatzyPlayer object for next round of yatzy.
     * @returns void
     */
    final public function setForNextRound(): void
    {
        $this->rolls = 0;
        $this->lastRoll = [];
        $this->stopped = false;
    }
}
