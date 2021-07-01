<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;

/**
 * Trait ResultsAsStringTrait
 * @package daap19\Dice
 */
trait LastRollAsStringTrait
{
    public function getLastRollAsString(): string
    {
        $numberOfDices = count($this->lastRoll);
        $outputString = "";

        foreach ($this->lastRoll as $key => $diceValue) {
            if ($key < $numberOfDices -1) {
                $outputString .= $this->lastRoll[$key] . ", ";
            } else if ($key === $numberOfDices -1) {
                $outputString .= $this->lastRoll[$key] . " = " . array_sum($this->lastRoll);
            }
        }

        return $outputString;
    }
}
