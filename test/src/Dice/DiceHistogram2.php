<?php

namespace Dicersice\Dice;

class DiceHistogram2 extends Dice implements HistogramInterface
{
    use HistogramTrait2;

    /**
     * @name getHistogramMax
     * @description Get max value for the histogram.
     * @return int as max value.
     */
    public function getHistogramMax()
    {
        return $this->faces;
    }

    /**
     * @return int as value from dice roll/throw.
     */
    public function roll(): int
    {
        $this->serie[] = parent::roll();
        return $this->getLastRoll();
    }
}
