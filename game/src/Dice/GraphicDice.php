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
     * @method __construct()
     * @description Class constructor method.
     */
    public function __construct()
    {
        parent::__construct(self::SIDES);
    }

    /**
     * @method graphicDice()
     * @description Returns a string that represents a class to use for revealing the right graphic representation of the value of the dice roll.
     * @return string as the class to represent the value of the dice roll.
     */
    public function graphicDice(): string
    {
        return "dice-" . $this->getLastRoll();
    }
}
