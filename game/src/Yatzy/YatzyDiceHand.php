<?php

/**
 * Namespace.
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
    public function __construct()
    {
        parent::__construct(self::DICESINHAND, self::FACESOFDICE); // construct from parent class.
    }


    /**
     * @method roll()
     * @description Method to roll the dice objects in dice hand for new values.
     * @return array
     */
    public function roll(): array
    {
        $oldValues = $this->getLastRoll();
        $this->lastRoll = [];

        foreach ($this->dices as $key => $dice) {
            if (in_array($key, $this->keepDices)) {
                $this->lastRoll[$key] = $oldValues[$key];
            } elseif (!in_array($key, $this->keepDices)) {
                $this->lastRoll[$key] = $dice->roll();
            }
        }

        return $this->lastRoll;
    }


    /**
     * @method keepDices()
     * @description Method to keep/hold dices to enable rolling the other dices in dice hand.
     * @param array $dices
     * @return array of dice objects
     */
    public function keepDices(array $dices)
    {
        $this->keepDices = []; // Clearing of earlier kept dices.

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
    public function getKeptDices(): array
    {
        return $this->keepDices;
    }


    /**
     * @method setForNextRound()
     * @description Setter method to prepare diceHand object for next round of yatzy.
     * @return void
     */
    public function setForNextRound(): void
    {
        $this->lastRoll = [];
        $this->keepDices = [];
    }
}
