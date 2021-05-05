<?php

namespace Dicersice\Dice;

/**
 * @name HistogramInterface
 * @description A interface for a classes supporting histogram reports.
 * Interface HistogramInterface
 * @package Dicersice\Dice
 */
interface HistogramInterface
{
    /**
     * @name getHistogramSerie
     * @description Get array containing integers as the serie representing the dice rolls.
     * @return array of integers
     */
    public function getHistogramSerie();

    /**
     * @name getHistogramMin
     * @description Get integer with the min value.
     * @return int
     */
    public function getHistogramMin();

    /**
     * @name getHistogramMax
     * @description Get integer with the max value.
     * @return int
     */
    public function getHistogramMax();
}
