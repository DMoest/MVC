<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;

/**
 * Interface PlayerInterface
 * @package daap19\Dice
 */
interface PlayerInterface
{
    public function rollDices(): array;
    public function getLastRoll(): array;
    public function getLastHand(): object;
    public function getResults(): array;
    public function getResultsAsString(): string;
    public function getSumTotal(): int;
    public function getAverage(): ?float;
    public function getLastRollAsString(): string;
}
