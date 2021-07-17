<?php

declare(strict_types=1);

namespace daap19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class ResultsTraitTest extends TestCase
{
    /**
     * @description Test Player class with trait ResultsAsString with method getResultsAsString.
     */
    final public function testPlayerTraitResultsAsStringMethod(): void
    {
        $player = new Player();

        $player->rollDices(6);
        $resultString = $player->getResultsAsString();

        $this->assertIsString($resultString);
    }


    /**
     * @description Test Player class with trait ResultsAsString with method getLastRollAsString.
     */
    final public function testPlayerTraitLastRollAsStringMethod(): void
    {
        $player = new Player();

        $player->rollDices(6);
        $lastRollString = $player->getLastRollAsString();

        $this->assertIsString($lastRollString);
    }
}
