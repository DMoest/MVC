<?php

declare(strict_types=1);

namespace daap19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class PlayerTest extends TestCase
{
    /**
     * @description Test Player class __construct() method.
     */
    public function testPlayerConstruct()
    {
        $player = new Player();

        $this->assertIsObject($player);
        $this->assertInstanceOf("daap19\Dice\Player", $player);

        $playerSum = $player->getSumTotal();
        $this->assertEquals(0, $playerSum);

        $average = $player->getAverage();
        $this->assertEquals(0, $average);
    }


    /**
     * @description Test Player rollDices() method.
     */
    public function testPlayerRollDices()
    {
        $player = new Player();

        $diceHand = $player->rollDices(3, 6);
        $this->assertIsArray($diceHand);
        $this->assertCount(3, $diceHand);

        $sum = $player->getSumTotal();
        $this->assertIsInt($sum);
        $this->assertEquals(array_sum($diceHand), $sum);
    }


    /**
     * Test Player getResults method.
     */
    public function testPlayerResults()
    {
        $player = new Player();

        $diceHand = $player->rollDices();
        $this->assertIsArray($diceHand);

        $results = $player->getResults();
        $this->assertIsArray($results);

        $this->assertEquals(array_sum($diceHand), array_sum($results));
    }


    /**
     * @description Test player getLastRoll() method.
     */
    public function testPlayerGetLastRoll()
    {
        $player = new Player();

        $player->rollDices(6);
        $lastRoll = $player->getLastRoll();
        $this->assertCount(6, $lastRoll);
    }


    /**
     * @description Test player getLastHand() method.
     */
    public function testPlayerGetLastHand()
    {
        $player = new Player();

        $player->rollDices(4);
        $lastHand = $player->getLastHand();
        $this->assertIsObject($lastHand);
    }


    /**
     * @description Test player getAverage method.
     */
    public function testPlayerAverage()
    {
        $player = new Player();

        $average = $player->getAverage();
        $this->assertNull($average);
        $this->assertEquals(0, $average);

        $player->rollDices(6);
        $average = $player->getAverage();
        $this->assertIsFloat($average);
    }
}
