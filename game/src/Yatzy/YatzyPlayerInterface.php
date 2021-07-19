<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Yatzy;

/**
 * Interface DicePlayerInterface
 * @package daap19\Yatzy
 * @property ?int $rolls
 * @property ?object $diceHand
 * @property ?array $keepDices
 * @property bool $stopped
 * @property array $playerScores
 */
interface YatzyPlayerInterface
{
    public function __construct();
    public function rollDices(int $dices = 5, int $faces = 6): array;
    public function getRolls(): int;
    public function getScore(): int;
    public function getPlayerScore(): array;
    public function getPlayerScoreSum(): int;
    public function saveScores(array $chosenScores, int $referenceValue): void;
    public function getAmountOfScoresSaved(): int;
    public function getDiceHand(): ?object;
    public function keepDices(array $diceIndexes): array;
    public function getKeptDices(): array;
    public function stop(): void;
    public function hasStopped(): bool;
    public function setForNextRound(): void;
}
