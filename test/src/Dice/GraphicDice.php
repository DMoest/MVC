<?php
/**
 * GrapicDice class testing.
 */

/**
 * Namespace.
 */
namespace Dicersice\Dice;
use Dicersice\Dice\Dice;

/**
 * Class DiceGraphic
 * @package Dicersice\DiceGraphic
 */
class GraphicDice extends Dice
{
    private const SIDES = 6;

    /**
     * DiceGraphic constructor.
     */
    public function __construct()
    {
        parent::__construct(self::SIDES);
    }

    /**
     * @name showGraphic
     * @description returns a string that represents a class to reveal the right graphic representation of the value of the dice roll.
     * @return string as the class to represent the value of the dice roll.
     */
    public function graphicDice(): string
    {
        return "dice-" . $this->getLastRoll();
    }
}

