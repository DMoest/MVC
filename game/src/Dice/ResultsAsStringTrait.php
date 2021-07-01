<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;

/**
 * Trait ResultsAsStringTrait
 * @package daap19\Dice
 */
trait ResultsAsStringTrait
{
    public function getResultsAsString(): string
    {
        $numberOfDices = count($this->results);
        $outputString = "";

        foreach ($this->results as $key => $diceValue) {
            if ($key < $numberOfDices -1) {
                $outputString .= $diceValue . ", ";
            } else if ($key === $numberOfDices -1) {
                $outputString .= $diceValue . " = " . array_sum($this->results);
            }
        }

        return $outputString;
    }
}
