<?php

/**
 * Namespace.
 */
namespace daap19\Dice;

/**
 * @name DiceHand
 * @description Class DiceHand to roll one or more dices at the same time. Works with the class Dice to create a hand of dice objects.
 * @package Dicersice\DiceHand
 */
class DiceHand implements DiceHandInterface
{
    private int $faces;
    protected array $dices = [];
    private ?int $numberOfDices;
    protected array $lastRoll = [];
    private ?int $sum;
    private ?float $average;


    /**
     * @method __construct()
     * @description DiceHand class constructor method. Takes two arguments, number of dices in diceHand object and the number of faces of each dice. From arguments
     * @param int $dicesInHand as number of dices in hand.
     * @param int $faces as faces of the dices to be rolled/thrown.
     */
    public function __construct(int $dicesInHand = 1, int $faces = 6)
    {
        $this->numberOfDices = $dicesInHand;
        $this->faces = $faces;

        for ($i = 0; $i < $this->numberOfDices; $i++) {
            $this->dices[] = new DiceGraphic();
        }

        $this->sum = 0;
        $this->average = 0;
    }


    /**
     * DiceHand destructor.
     */
//    final public function __destruct()
//    {
//        echo __METHOD__;
//    }


    /**
     * @method roll()
     * @description setter method to roll the dices with. Clears the array that holds the last rolled dices. Thru a for-loop iterates, rolls the dice and stores the new value to the array on the property lastHand.
     * @return array as the results of all the dice rolls/throws.
     */
    public function roll(): array
    {
        $this->lastRoll = []; // Clear array of values from last roll.

        foreach ($this->dices as $key => $diceObject) {
            $this->lastRoll[$key] = $diceObject->roll();
        }

        return $this->lastRoll;
    }


    /**
     * @method getDices()
     * @description Getter method that returns array that holds all the dices in the dice hand as objects of Dice class.
     * @return array as all the dice objects.
     */
    final public function getDices(): array
    {
        return $this->dices;
    }


    /**
     * @method getLastRoll()
     * @description returns array of integers as values from last dicehand rolled.
     * @return array of integers
     */
    final public function getLastRoll(): array
    {
        return $this->lastRoll;
    }


    /**
     * @method getLastRollAsString()
     * @description returns the values from the last rolled dices as string.
     * @return string
     */
    final public function getLastRollAsString(): string
    {
        $response = "";

        /* Build string from results */
        foreach ($this->lastRoll as $dice) {
            $response .= $dice . ", ";
        }

        /* Trim last two characters off */
        $response = substr($response, 0, strlen($response)-2);

        return $response . " = " . array_sum($this->lastRoll);
    }


    /**
     * @method getSum()
     * @description getter method that returns integer value as sum of last rolled dices.
     * @return int as sum of values from dices.
     */
    final public function getSum(): int
    {
        return array_sum($this->lastRoll);
    }


    /**
     * @method getAverage()
     * @description getter method that returns the average float|integer value of dice hand results.
     * @return float|null
     */
    final public function getAverage(): ?float
    {
        if (array_sum($this->lastRoll) !== 0) {
            return round(array_sum($this->lastRoll) / count($this->lastRoll), 2);
        }

        return 0;
    }
}
