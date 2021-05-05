<?php

namespace Dicersice\Dice;

use \Dicersice\Dice\HistogramTrait;

/**
 * Class DiceHistogram
 * @package Dicersice\Dice
 */
class DiceHistogram extends Dice
{
    use HistogramTrait;

    /**
     * @return int as result from last dice roll.
     */
    public function roll(): int
    {
        $this->serie[] = parent::roll();
        return $this->getLastRoll();
    }
}
