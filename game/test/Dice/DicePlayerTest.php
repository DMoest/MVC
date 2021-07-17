<?php

declare(strict_types=1);

namespace daap19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class DicePlayerTest extends TestCase
{
    /**
     * @description Test DicePlayers constructor method.
     */
    final public function testDicePlayerConstructor(): void
    {
        $player = new DicePlayer();

        $this->assertIsObject($player);
        $this->assertInstanceOf("daap19\Dice\DicePlayer", $player);
    }


    /**
     * @description Test DicePlayer getScore method return type.
     */
    final public function testDicePlayerGetScore(): void
    {
        $player = new DicePlayer();

        $player->rollDices();

        $score = $player->getScore();
        $this->assertIsInt($score);
    }


    /**
     * @description Test DicePlayer getCredit method return type.
     */
    final public function testDicePlayerGetCredit(): void
    {
        $player = new DicePlayer();

        $credit = $player->getCredit();
        $this->assertIsInt($credit);
    }


    /**
     * @description Test DicePlayer setCredit method functionality.
     */
    final public function testDicePlayerSetCredit(): void
    {
        $player = new DicePlayer();

        $credit1 = $player->getCredit();
        $credit2 = $credit1 * 3;
        $player->setCredit($credit2);
        $credit2 = $player->getCredit();

        $this->assertIsInt($credit1);
        $this->assertIsInt($credit2);
        $this->assertNotEquals($credit1, $credit2);
    }


    /**
     * @description Test DicePlayer getWins method return type and value after class construct.
     */
    final public function testDicePlayerGetWinsAfterClassConstruct(): void
    {
        $player = new DicePlayer();

        $wins = $player->getWins();
        $this->assertIsInt($wins);
        $this->assertEquals(0, $wins);
    }


    /**
     * @description Test DicePlayer setWins method return type after DicePlayer wins a game round.
     */
    final public function testDicePlayerGetWinsAfterPlayerWin(): void
    {
        $player = new DicePlayer();

        $player->setWin();
        $wins = $player->getWins();
        $this->assertIsInt($wins);
        $this->assertEquals(1, $wins);
    }


    /**
     * @description Test DicePlayer stop property after class construct.
     */
    final public function testDicePlayerStopAfterConstruct(): void
    {
        $player = new DicePlayer();

        $stopped = $player->hasStopped();
        $this->assertIsBool($stopped);
        $this->assertEquals(false, $stopped);
    }


    /**
     * @description Test DicePlayer stop property after player stops.
     */
    final public function testDicePlayerStop(): void
    {
        $player = new DicePlayer();

        $player->stop();
        $stopped = $player->hasStopped();
        $this->assertIsBool($stopped);
        $this->assertEquals(true, $stopped);
    }


    /**
     * @description Test DicePlayer bust property after class construct.
     */
    final public function testDicePlayerBustAfterConstruct(): void
    {
        $player = new DicePlayer();

        $bust = $player->isBust();
        $this->assertIsBool($bust);
        $this->assertEquals(false, $bust);
    }


    /**
     * @description Test DicePlayer bust property after player goes bust in a game round.
     */
    final public function testDicePlayerGoingBust(): void
    {
        $player = new DicePlayer();

        $player->setBust();
        $bust = $player->isBust();
        $this->assertIsBool($bust);
        $this->assertEquals(true, $bust);
    }


    /**
     * @description Test DicePlayer out property after class construct.
     */
    final public function testDicePlayerOutAfterConstruct(): void
    {
        $player = new DicePlayer();

        $out = $player->isOut();
        $this->assertIsBool($out);
        $this->assertEquals(false, $out);
    }


    /**
     * @description Test DicePlayer out property after player is out of the game.
     */
    final public function testDicePlayerOut(): void
    {
        $player = new DicePlayer();

        $player->setOut();
        $out = $player->isOut();
        $this->assertIsBool($out);
        $this->assertEquals(true, $out);
    }


    /**
     * @description Test machine operated DicePlayer after construct.
     */
    final public function testMachineDicePlayer(): void
    {
        $player = new DicePlayer(25, 1);

        $machine = $player->isMachine();
        $credit = $player->getCredit();

        $this->assertIsObject($player);
        $this->assertIsBool($machine);
        $this->assertEquals(true, $machine);
        $this->assertIsInt($credit);
        $this->assertEquals(25, $credit);
    }


    /**
     * @description Test DicePlayer set for next game round method.
     */
    final public function testPlayerSetForNextRound(): void
    {
        $player = new DicePlayer(25, 1);

        /* Pre setForNextRound */
        $rolledLastRoll = $player->rollDices(5);
        $rolledResults = $player->getResults();
        $rolledSum = $player->getSumTotal();
        $rolledAverage = $player->getAverage();
        $player->stop();
        $setStop = $player->hasStopped();
        $player->setBust();
        $setBust = $player->isBust();
        $player->setForNextRound();

        /* Post setForNextRound */
        $resetResults = $player->getResults();
        $resetLastRoll = $player->getLastRoll();
        $resetSum = $player->getSumTotal();
        $resetAverage = $player->getAverage();
        $resetStop = $player->hasStopped();
        $resetBust = $player->isBust();

        /* Testing */
        $this->assertIsArray($rolledLastRoll);
        $this->assertIsArray($resetLastRoll);
        $this->assertEmpty($resetLastRoll);
        $this->assertIsArray($rolledResults);
        $this->assertIsArray($resetResults);
        $this->assertEmpty($resetResults);
        $this->assertIsInt($rolledSum);
        $this->assertIsInt($resetSum);
        $this->assertEquals(0, $resetSum);
        $this->assertIsFloat($rolledAverage);
        $this->assertNull($resetAverage);
        $this->assertEquals(0, $resetAverage);
        $this->assertIsBool($setStop);
        $this->assertTrue($setStop);
        $this->assertIsBool($resetStop);
        $this->assertFalse($resetStop);
        $this->assertIsBool($setBust);
        $this->assertTrue($setBust);
        $this->assertIsBool($resetBust);
        $this->assertFalse($resetBust);
    }

    /**
     * @description Test DicePlayer set for next game round method if credit is zero.
     */
    final public function testPlayerSetForNextRoundZeroCredit(): void
    {
        $player = new DicePlayer(25, 1);

        $player->stop();
        $stopped = $player->hasStopped();
        $player->setCredit(0);
        $player->setForNextRound();

        $this->assertIsBool($stopped);
        $this->assertTrue($stopped);
    }
}
