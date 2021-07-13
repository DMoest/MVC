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
    public function getPlayerScore(): array;
    public function getPlayerScoreSum(): int;
    public function getAmountOfScoresSaved(): int;
    public function validateScoreValues(array $diceHandArray, int $valueToBe): ?bool;
    public function saveScores(array $chosenScores, int $referenceValue): void;
    public function setForNextRound(): void;
}
