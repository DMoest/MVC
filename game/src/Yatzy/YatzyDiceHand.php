<?php


/**
 * Namespace declared and others in use.
 */
namespace daap19\Yatzy;
use daap19\Dice\DiceHand;


/**
 * @name YatzyDiceHand
 * @package daap19\Yatzy
 */
class YatzyDiceHand extends DiceHand implements YatzyDiceHandInterface
{
    protected array $keepDices = [];
    private const DICESINHAND = 5;
    private const FACESOFDICE = 6;

    /**
     * YatzyDiceHand constructor.
     */
    final public function __construct()
    {
        parent::__construct(self::DICESINHAND, self::FACESOFDICE); // construct from parent class.
    }


    /**
     * @method roll()
     * @description Method to roll the dice objects in dice hand for new values.
     * @return array
     */
    final public function roll(): array
    {
        $diceHand = $this->getDices();
        $lastRoll = $this->getLastRoll();
        $keepers = $this->getKeptDices();

        foreach ($diceHand as $key => $dice) {
            if (in_array($dice, $keepers)) {
                $this->lastRoll[$key] = $lastRoll[$key];
            } elseif (!in_array($dice, $keepers)) {
                $this->lastRoll[$key] = $dice->roll();
            }
        }

        return $this->lastRoll;
    }


    /**
     * @method keepDices()
     * @description Method to keep/hold dices to enable rolling the other dices in dice hand.
     * @param array $dices as array of dice objects.
     * @return array of dice objects to keep.
     */
    final public function keepDices(array $dices)
    {

        $this->clearKeptDices(); // Clearing of earlier kept dices.

        foreach ($dices as $key => $dice) {
            $this->keepDices[$key] = $dice;
        }

        return $this->keepDices;
    }


    /**
     * @method getKeptDices()
     * @description Getter method to return the kept/held dices of dice hand.
     * @return array of dice objects
     */
    final public function getKeptDices(): array
    {
        return $this->keepDices;
    }


    /**
     * @method clearKeptDices()
     * @description Setter method to clear all kept dices.
     * @return void
     */
    final public function clearKeptDices(): void
    {
        $this->keepDices = [];
    }


    /**
     * @method setForNextRound()
     * @description Setter method to prepare diceHand object for next round of yatzy.
     * @return void
     */
    final public function setForNextRound(): void
    {
        $this->lastRoll = [];
        $this->keepDices = [];
    }
}
