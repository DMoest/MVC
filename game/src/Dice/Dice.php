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
    private ?int $faces = null;
    private ?int $roll = null;
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
        $this->roll = mt_rand(1, $this->faces); // Random integer 1 to 6 integer.
        $this->lastRoll = $this->roll;

        return $this->roll;
    }

    /**
     * @method getFaces()
     * @description getter method to get the number of faces of the dice object.
     * @return int|null of faces of the dice.
     */
    public function getFaces(): ?int
    {
        return $this->faces;
    }

    /**
     * @method getLastRoll()
     * @description getter method to get the last roll/throw of the dice.
     * @return int
     */
    public function getLastRoll(): int
    {
        return $this->lastRoll;
    }
}
