<?php

declare(strict_types=1);

namespace daap19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class DiceGameMachinePlayerTest extends TestCase
{
    protected object $diceGame;


    /**
     * @description setUp for test suit. Each test case will run this at first.
     */
    final protected function setUp(): void
    {
        $this->diceGame = new DiceGame21(2, 25, true);
    }


    /**
     * @description tearDown for test suit. Each test case will run this when done is done.
     */
    final protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }


    /**
     * @description Test DiceGame class construct method with machine player. Test properties initial values with expectence of last player as machine in the players array.
     */
    final public function testDiceGameConstructMachinePlayer(): void
    {
        /* Setup test case */
        $players = $this->diceGame->getPlayers();
        $index = array_key_last($players);
        $credit = $players[$index]->getCredit();
        $wins = $players[$index]->getWins();
        $stopped = $players[$index]->hasStopped();
        $bust = $players[$index]->isBust();
        $out = $players[$index]->isOut();
        $machine = $players[$index]->isMachine();

        /* Test case assertions */
        $this->assertNotEmpty($players);
        $this->assertIsInt($credit);
        $this->assertEquals(25, $credit);
        $this->assertIsInt($wins);
        $this->assertEquals(0, $wins);
        $this->assertIsBool($stopped);
        $this->assertFalse($stopped);
        $this->assertIsBool($bust);
        $this->assertFalse($bust);
        $this->assertIsBool($out);
        $this->assertFalse($out);
        $this->assertIsBool($machine);
        $this->assertTrue($machine);
    }


    /**
     * @description Test DiceGame method playGame for machine player.
     */
    final public function testDiceGamePlayGameMachinePlayer(): void
    {
        /* Setup test case */
        $this->diceGame->setNextPlayerIndex(); // Should make player machine player in this case.
        $this->diceGame->playGame(2, "roll");
        $players = $this->diceGame->getPlayers();
        $index = $this->diceGame->getPlayerIndex();
        $player = $players[$index];
        $results = $player->getResults();
        $machine = $player->isMachine();

        /* test case assertions */
        $this->assertTrue($machine);
        $this->assertNotEmpty($results);
    }


    /**
     * @description Test DiceGame method playComputer.
     */
    final public function testDiceMachnePlayerMethodPlayComputer(): void
    {
        /* Setup test case */
        $players = $this->diceGame->getPlayers();
        $player = $players[array_key_last($players)];
        $this->diceGame->playComputer($player);
        $score = $player->getSumTotal();
        $stopped = $player->hasStopped();
        $bust = $player->isBust();

        /* Test case assertions */
        $this->assertIsInt($score);
        $this->assertNotEquals(0, $score);
        $this->assertIsBool($stopped);
        $this->assertIsBool($bust);
    }
}
