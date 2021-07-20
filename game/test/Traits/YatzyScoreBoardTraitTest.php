<?php

declare(strict_types=1);

namespace daap19\Yatzy;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class YatzyScoreBoardTraitTest extends TestCase
{
    protected object $yatzy;


    /**
     * @description setUp for test suit. Each test case will run this at first.
     */
    final protected function setUp(): void
    {
        $this->yatzy = new Yatzy();
    }


    /**
     * @description tearDown for test suit. Each test case will run this when done is done.
     */
    final protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }


    /**
     * @description Test Yatzy class with trait ScoreBoardTrait with method printYatzyScoreBoard.
     */
    final public function testYatzyTraitPrintScoreBoardMethod(): void
    {
        /* setup test case */
        $player = $this->yatzy->getCurrentPlayer();
        $player->rollDices();
        $player->rollDices();
        $player->rollDices();
        $scoreBoard = $this->yatzy->printYatzyScoreBoard();

        /* Test case asertions */
        $this->assertTrue(method_exists($this->yatzy, "printYatzyScoreBoard"), "Class does not have expected method printDiceScoreBoard.");
        $this->assertIsString($scoreBoard);
    }
}
