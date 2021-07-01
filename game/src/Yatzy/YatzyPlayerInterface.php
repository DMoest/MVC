<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Yatzy;

/**
 * Interface DicePlayerInterface
 * @package daap19\Yatzy
 */
interface YatzyPlayerInterface
{
    public function rollDices(int $dices = 5, int $faces = 6): array;
    public function stop(): void;
    public function hasStopped(): bool;
    public function keepDices(array $diceIndexes): array;
    public function getDiceHand(): ?object;
    public function validateScoreValues(array $chosenScores, int $valueToBe): ?bool;
    public function saveScores(array $theChosenScores, int $theValue): array;


    /* Yatzy stuff */
    // Some method to keep dices
    // Make override on function rollDices to implement "keep" dices.
    //
}
