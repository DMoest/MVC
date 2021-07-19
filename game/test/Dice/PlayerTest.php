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

        $results = $player->getResults();
        $lastRoll = $player->getLastRoll();
//        $lastHand = $player->getLastHand();
        $sum = $player->getSumTotal();
        $average = $player->getAverage();

        $this->assertIsObject($player);
        $this->assertInstanceOf("daap19\Dice\Player", $player);

        /* Test Player attributes */
        $this->assertObjectHasAttribute("results", $player);
        $this->assertObjectHasAttribute("lastRoll", $player);
        $this->assertObjectHasAttribute("lastHand", $player);
        $this->assertObjectHasAttribute("sum", $player);
        $this->assertObjectHasAttribute("average", $player);
        $this->assertObjectHasAttribute("faces", $player);
        $this->assertObjectHasAttribute("dices", $player);

        /* Test property types */
        $this->assertIsArray($results);
        $this->assertIsArray($lastRoll);
//        $this->assertNull($lastHand);
        $this->assertIsInt($sum);
        $this->assertIsFloat($average);

        /* Test existence of expected class methods */
        $this->assertTrue(method_exists($player, "__construct"), "Class does not have expected method __construct.");
        $this->assertTrue(method_exists($player, "rollDices"), "Class does not have expected method rollDices.");
        $this->assertTrue(method_exists($player, "getResults"), "Class does not have expected method getResults.");
        $this->assertTrue(method_exists($player, "getSumTotal"), "Class does not have expected method getSumTotal.");
        $this->assertTrue(method_exists($player, "getLastRoll"), "Class does not have expected method getLastRoll.");
        $this->assertTrue(method_exists($player, "getLastHand"), "Class does not have expected method getLastHand.");
        $this->assertTrue(method_exists($player, "getAverage"), "Class does not have expected method getAverage.");

        /* Test initial values */
        $this->assertEquals([], $results);
        $this->assertEquals([], $lastRoll);
        $this->assertEquals(0, $sum);
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
        $this->assertIsFloat($average);
        $this->assertEquals(0, $average);

        $player->rollDices(6);
        $average = $player->getAverage();
        $this->assertIsFloat($average);
    }
}
