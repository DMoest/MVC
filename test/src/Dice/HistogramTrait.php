<?php

namespace Dicersice\Dice;

trait HistogramTrait
{
    private $serie = [];
    private $histogram = [];
    private $output = "";
    private $average = null;

    /**
     * @name getHistogramSerie
     * @description returns arras as series of integers representing serie of dice rolls.
     * @return array as series of integers.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }

    /**
     * @return float as average value from series of dice rolls/throws.
     */
    public function getAverage()
    {
        foreach ($this->serie as $value) {
            $this->average += $value;
        }

        $this->average /= count($this->serie);

        return round($this->average, 2);
    }

    /**
     * @param int|null $min
     * @param int|null $max
     * @return string
     */
    public function printHistogram(int $min = null, int $max = null)
    {
        /* Start tag of ordered list */
        $this->output = "<ol>";

        if ($min === null) {
            $min = 1;
        }

        if ($max === null) {
            $max = 6;
        }

        /* Build statistics with stars */
        foreach ($this->serie as $key => $value) {
            echo "key: " . $key . " value: " . $value . " min: " . $min . " max: " . $max . " \n";
            $stars = "";

            /* Build string of stars representing $value */
            for ($i = 0; $i < $value; $i++) {
                $stars .= "*";
            }

            /* Add to array if within min/max range */
            if (($value >= $min) && ($value <= $max)) {
                $this->histogram[] = $stars;
            } else {
                $this->histogram[] = "";
            }

            unset($key, $value);
        }

        /* Build list items from array */
        foreach ($this->histogram as $stats) {
            $item = "<li>" . $stats . "</li>";
            $this->output .= $item;
            unset($stats);
        }

        /* Add ending tag on ordered list */
        $this->output .= "<ol>";

        return $this->output;
    }

    /**
     * @name reset
     * @return void
     */
    public function reset()
    {
        $this->serie = [];
        $this->histogram = "";
    }
}
