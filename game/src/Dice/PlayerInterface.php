<?php


/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;


/**
 * Interface PlayerInterface
 * @package daap19\Dice
 * @property array $results
 * @property array $lastRoll
 * @property object $lastHand
 * @property ?int $sum
 * @property ?float $average
 * @property int $faces
 * @property int $dices
 */
interface PlayerInterface
{
    public function __construct();
    public function rollDices(int $dices, int $faces): array;
    public function getLastRoll(): array;
    public function getLastHand(): object;
    public function getResults(): array;
    public function getSumTotal(): int;
    public function getAverage(): ?float;
}
