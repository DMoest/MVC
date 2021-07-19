<?php

declare(strict_types=1);

namespace daap19\Dice;

use daap19\Yatzy\Yatzy;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class ScoreBoardTraitTest extends TestCase
{
    /**
     * @description Test DiceGame class with trait ScoreBoardTrait with method printDiceScoreBoard.
     */
    final public function testDiceGamePrintScoreBoardMethod(): void
    {
        /* setup test case */
        $diceGame = new DiceGame(3, 25, false);
        $index = $diceGame->getPlayerIndex();
        $players = $diceGame->getPlayers();
        $player = $players[$index];
        $player->rollDices();
        $player->rollDices();
        $player->rollDices();
        $stopped = $player->hasStopped();
        $bust = $player->isBust();
        $scoreBoard = $diceGame->printDiceScoreBoard();

        /* Test case asertions */
        $this->assertFalse($stopped);
        $this->assertFalse($bust);
        $this->assertTrue(method_exists($diceGame, "printDiceScoreBoard"), "Class does not have expected method printDiceScoreBoard.");
        $this->assertIsString($scoreBoard);
    }


    /**
     * @description Test DiceGame class with trait ScoreBoardTrait with method printDiceScoreBoard, player has stopped.
     */
    final public function testDiceGamePrintScoreBoardMethodPlayerStopped(): void
    {
        /* setup test case */
        $diceGame = new DiceGame(3, 25, false);
        $index = $diceGame->getPlayerIndex();
        $players = $diceGame->getPlayers();
        $player = $players[$index];
        $player->rollDices();
        $player->rollDices();
        $player->stop();
        $stopped = $player->hasStopped();
        $bust = $player->isBust();
        $playerWin = $player->getWins();
        $this->assertEquals(0, $playerWin);
        $scoreBoard = $diceGame->printDiceScoreBoard();

        /* Test case asertions */
        $this->assertTrue($stopped);
        $this->assertFalse($bust);
        $this->assertTrue(method_exists($diceGame, "printDiceScoreBoard"), "Class does not have expected method printDiceScoreBoard.");
        $this->assertIsString($scoreBoard);
    }


    /**
     * @description Test DiceGame class with trait ScoreBoardTrait with method printDiceScoreBoard, player has stopped.
     */
    final public function testDiceGamePrintScoreBoardMethodPlayerHaveWon(): void
    {
        /* setup test case */
        $diceGame = new DiceGame(3, 25, false);
        $index = $diceGame->getPlayerIndex();
        $players = $diceGame->getPlayers();
        $player = $players[$index];
        $player->rollDices();
        $player->rollDices();
        $stopped = $player->hasStopped();
        $bust = $player->isBust();
        $player->setWin();
        $playerWin = $player->getWins();
        $scoreBoard = $diceGame->printDiceScoreBoard();

        /* Test case asertions */
        $this->assertFalse($stopped);
        $this->assertFalse($bust);
        $this->assertEquals(1, $playerWin);
        $this->assertTrue(method_exists($diceGame, "printDiceScoreBoard"), "Class does not have expected method printDiceScoreBoard.");
        $this->assertIsString($scoreBoard);
    }


    /**
     * @description Test DiceGame class with trait ScoreBoardTrait with method printDiceScoreBoard, player is bust.
     */
    final public function testDiceGamePrintScoreBoardMethodPlayerBust(): void
    {
        /* setup test case */
        $diceGame = new DiceGame(3, 25, false);
        $index = $diceGame->getPlayerIndex();
        $players = $diceGame->getPlayers();
        $player = $players[$index];
        $player->rollDices();
        $player->rollDices();
        $player->setBust();
        $bust = $player->isBust();
        $stopped = $player->hasStopped();
        $playerWin = $player->getWins();
        $scoreBoard = $diceGame->printDiceScoreBoard();

        /* Test case asertions */
        $this->assertFalse($stopped);
        $this->assertTrue($bust);
        $this->assertEquals(0, $playerWin);
        $this->assertTrue(method_exists($diceGame, "printDiceScoreBoard"), "Class does not have expected method printDiceScoreBoard.");
        $this->assertIsString($scoreBoard);
    }


    /**
     * @description Test Yatzy class with trait ScoreBoardTrait with method printYatzyScoreBoard.
     */
    final public function testYatzyTraitPrintScoreBoardMethod(): void
    {
        /* setup test case */
        $yatzy = new Yatzy();
        $player = $yatzy->getCurrentPlayer();
        $player->rollDices();
        $player->rollDices();
        $player->rollDices();
        $scoreBoard = $yatzy->printYatzyScoreBoard();

        /* Test case asertions */
        $this->assertTrue(method_exists($yatzy, "printYatzyScoreBoard"), "Class does not have expected method printDiceScoreBoard.");
        $this->assertIsString($scoreBoard);
    }
}
