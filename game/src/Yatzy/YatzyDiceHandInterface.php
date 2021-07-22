<?php


/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Yatzy;


/**
 * Interface PlayerInterface
 * @package daap19\Dice
 */
interface YatzyDiceHandInterface
{
    public function __construct();
    public function roll(): array;
    public function keepDices(array $dices);
    public function clearKeptDices(): void;
    public function getKeptDices(): array;
    public function setForNextRound(): void;
}
