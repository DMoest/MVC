<?php

namespace Dicersice\Dice;

trait HistogramTrait2
{
    private $serie = [];

    public function getHistogramSerie()
    {
        return $this->serie;
    }

    public function getHistogramMin()
    {
        return 1;
    }

    public function getHistogramMax()
    {
        return max($this->serie);
    }
}
