<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;

/**
 * Interface DicePlayerInterface
 * @package daap19\Yatzy
 * @property int $credit
 * @property ?int $wins
 * @property bool $stopped
 * @property ?bool $bust
 * @property ?bool $out
 * @property bool $machine
 */
interface DicePlayerInterface
{
    public function __construct(int $startCredit, int $machinePlayer);
    public function getScore(): int;
    public function getCredit(): int;
    public function setCredit(int $newCredit): void;
    public function stop(): void;
    public function hasStopped(): bool;
    public function isBust(): bool;
    public function setBust(): void;
    public function isOut(): bool;
    public function setOut(): void;
    public function getWins(): ?int;
    public function setWin(): void;
    public function setForNextRound(): void;
    public function isMachine(): bool;
}
