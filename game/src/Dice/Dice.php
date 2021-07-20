<?php

/**
 * Namespace.
 */
namespace daap19\Dice;

/**
 * Include files.
 * Configuration file and autoloader.
 */
include(__DIR__ . "/../../config/config.php");

/**
 * @name Dice
 * @description Class Dice to represent a dice.
 * @package Daap19\Dice
 */
class Dice
{
    /**
     * @var int|null as the faces of the dice object.
     * @var int|null as the value of the dice roll.
     * @var array to store all the values rolled/thrown with the dice object.
     */
    private int $faces;
    private array $diceResults = [];
    private ?int $lastRoll = null;

    /**
     * @method __construct()
     * @description constructor method for the class Dice.
     * @param int $faces as number of faces on the Dice to be created.
     */
    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }

    /**
     * @method __destruct()
     * @description destructor method for the class Dice.
     * @return void
     */
//    public function __destruct()
//    {
//        echo __METHOD__;
//    }

    /**
     * @method roll()
     * @description method to roll/throw the dice.
     * @return int as result of the dice roll/throw.
     */
    public function roll(): int
    {
        $faces = $this->getFaces();
        $this->lastRoll = random_int(1, $faces); // Random integer 1 to 6 integer.
        $this->diceResults[] = $this->lastRoll;

        return $this->lastRoll;
    }

    /**
     * @method getFaces()
     * @description getter method to get the number of faces of the dice object.
     * @return int|null of faces of the dice.
     */
    public function getFaces(): int
    {
        return $this->faces;
    }

    /**
     * @method getLastRoll()
     * @description Getter method to return the last roll/throw value of the dice object.
     * @return ?int
     */
    public function getLastRoll(): ?int
    {
        return $this->lastRoll;
    }

    /**
     * @method getDiceResults()
     * @description Getter method to return all values ever rolled on this dice.
     * @returns array of integer values.
     */
    public function getDiceResults(): array
    {
        return $this->diceResults;
    }
}
