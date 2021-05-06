<?php

/**
 * Namespaces.
 */
namespace daap19\Dice;
use daap19\Dice\Dice;

/**
 * Class GraphicDice
 * @package Dicersice\GraphicDice
 */
class GraphicDice extends Dice
{
    private const SIDES = 6;

    /**
     * GraphicDice constructor.
     */
    public function __construct()
    {
        parent::__construct(self::SIDES);
    }

    /**
     * @method graphicDice()
     * @description returns a string that represents a class to reveal the right graphic representation of the value of the dice roll.
     * @return string as the class to represent the value of the dice roll.
     */
    public function graphicDice(): string
    {
        return "dice-" . $this->getLastRoll();
    }
}

