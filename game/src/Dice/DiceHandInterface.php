<?php


/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;


/**
 * Interface PlayerInterface
 * @package daap19\Dice
 */
interface DiceHandInterface
{
    public function __construct();
    public function roll(): array;
    public function getDices(): array;
    public function getLastRoll(): array;
    public function getLastRollAsString(): string;
    public function getSum(): int;
    public function getAverage(): ?float;
}
