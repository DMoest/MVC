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

    public function __construct()
    {
        parent::__construct(self::DICESINHAND, self::FACESOFDICE); // construct from parent class.
    }




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




    public function keepDices(array $dices)
    {
        $this->keepDices = []; // Clearing of earlier kept dices.

        foreach ($dices as $key => $dice) {
            $this->keepDices[$key] = $dice;
        }

        return $this->keepDices;
    }




    public function getKeptDices(): array
    {
        return $this->keepDices;
    }
}
