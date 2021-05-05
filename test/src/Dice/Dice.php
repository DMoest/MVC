<?php

/**
 * Namespace.
 */
namespace Dicersice\Dice;

/**
 * Include files.
 * Configuration file and autoloader.
 */
include(__DIR__ . "/../../config.php");

/**
 * Class Dice
 * @package Daap19\Dice
 */
class Dice
{
    /**
     * @var int|null as the faces of the dice object.
     * @var int|null as the value of the dice roll.
     * @var array to store all the values rolled/thrown with the dice object.
     */
    protected ?int $faces = null;
    private ?int $roll = null;
    private array $results = [];

    /**
     * @name Dice
     * @description constructor for the class Dice.
     * @param int $faces as number of faces on the Dice to be created.
     */
    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }

//    /**
//     * @name Dice
//     * @description destructor for the class Dice.
//     * @return void
//     */
//    public function __destruct()
//    {
//        echo __METHOD__;
//    }

    /**
     * @name roll
     * @description method to roll/throw the dice.
     * @return int as result of the dice roll/throw.
     */
    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);
        array_push($this->results, $this->roll);

        return $this->roll;
    }

    /**
     * @name getFaces
     * @description getter method to get the number of faces of the dice object.
     * @return int|null of faces of the dice.
     */
    public function getFaces(): ?int
    {
        return $this->faces;
    }

    /**
     * @name getLastRoll
     * @description getter method to get the last roll/throw of the dice.
     * @return int
     */
    public function getLastRoll(): int
    {
        return $this->roll;
    }

    /**
     * @name getResults
     * @description returns the array that holds all the rolls/throws on the dice.
     * @return array holding integer values.
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @name getSumOfRolls
     * @description returns the total sum of all the values in the array $results.
     * @return int as total sum of values in array.
     */
    public function getSumOfRolls(): int
    {
        return array_sum($this->results);
    }

    /**
     * @name getNumberOfRolls
     * @description returns the amount of times the dice have been thrown.
     * @return int as number of times the dice have been rolled/thrown.
     */
    public function getNumberOfRolls(): int
    {
        return count($this->results);
    }
}
