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
    public function stop(): void;
    public function hasStopped(): bool;
    public function keepDices(array $diceIndexes): array;

    /* Yatzy stuff */
// Some method to keep dices
// Make override on function rollDices to implement "keep" dices.
//
}
