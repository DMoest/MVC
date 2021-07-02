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
 * Class DicePlayer
 * @description Class DicePlayer extends the Player class. For easier use of same base class interfaces are implemented for each of the related classes.
 * @package daap19\Dice
 */
class DicePlayer extends Player implements DicePlayerInterface
{
    use ResultsAsStringTrait;

    private int $credit;
    private ?int $wins = null;
    private bool $stopped;
    private ?bool $bust = null;
    private ?bool $out = null;
    private bool $machine;


    /**
     * @method __construct()
     * @description YatzyPlayer class constructor method.
     * @param int $startCredit
     * @param bool $machinePlayer
     */
    public function __construct(int $startCredit = 25, bool $machinePlayer = true)
    {
        parent::__construct(); // construct from parent class.

        $this->credit = $startCredit;
        $this->stopped = false;
        $this->bust = false;
        $this->out = false;
        $this->machine = $machinePlayer;
    }


    /**
     * @method getScore()
     * @description returns a sum of all values in array of results.
     * @return int as player score.
     */
    public function getScore(): int
    {
        $valueArray = $this->getResults();

        return array_sum($valueArray);
    }


    /**
     * @method getCredit()
     * @description getter function to return players credit account.
     * @return int as value of player credit.
     */
    public function getCredit(): int
    {
        return $this->credit;
    }


    /**
     * @method setCredit()
     * @description setter function to set new credit to player credit account.
     * @param int $newCredit as the credit to set.
     * @return void
     */
    public function setCredit(int $newCredit): void
    {
        $this->credit = $newCredit;
    }


    /**
     * @method setWin
     * @description setter method that iterates the property wins +1.
     * @returns void
     */
    public function setWin(): void
    {
        $this->wins++;
    }


    /**
     * @method getWins()
     * @description getter method that returns the integer value of the property wins.
     * @return int
     */
    public function getWins(): ?int
    {
        return $this->wins;
    }


    /**
     * @method stop()
     * @description setter method to set boolean property to indicate that player have stopped at this score.
     * @return void
     */
    public function stop(): void
    {
        $this->stopped = true;
    }


    /**
     * @method hasStopped()
     * @description getter method that returns a boolean value to indiate if player have stopped or not.
     * @return bool as indicator if player have stopped.
     */
    public function hasStopped(): bool
    {
        return $this->stopped;
    }


    /**
     * @method isBust()
     * @description returns a boolean value to indicate if this player has gone bust in the current round.
     * @return bool
     */
    public function isBust(): bool
    {
        return $this->bust;
    }


    /**
     * @method setBust()
     * @description Setter method to set boolean value when player is bust in current round.
     * @return void
     */
    public function setBust(): void
    {
        $this->bust = true;
    }


    /**
     * @method isOut()
     * @description returns a boolean value to indicate if this player has gone bust in the current round.
     * @return bool
     */
    public function isOut(): bool
    {
        return $this->out;
    }


    /**
     * @method setOut()
     * @description Setter method to set boolean value when player is bust in current round.
     * @return void
     */
    public function setOut(): void
    {
        $this->out = true;
    }


    /**
     * @method isMachine()
     * @description returns boolean value to indicate if this player is run by computer/machine or not.
     * @return bool as indicator of machine player or not.
     */
    public function isMachine(): bool
    {
        return $this->machine;
    }


    /**
     * @method setForNextRound()
     * @description setter method that setts up a player for next round of dice game.
     * @return void
     */
    public function setForNextRound(): void
    {
        $this->results = [];
        $this->lastRoll = [];
        $this->sum = null;
        $this->average = null;
        $this->stopped = false;
        $this->bust = false;

        /* Check players credit */
        if ($this->credit === 0) {
            $this->stopped = true;
        }
    }
}
