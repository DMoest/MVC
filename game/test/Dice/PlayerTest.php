<?php

declare(strict_types=1);

namespace daap19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class PlayerTest extends TestCase
{
    protected object $player;


    /**
     * @description setUp for test suit. Each test case will run this at first.
     */
    final protected function setUp(): void
    {
        $this->player = new Player();
    }


    /**
     * @description tearDown for test suit. Each test case will run this when done is done.
     */
    final protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }


    /**
     * @description Test Player class __construct() method.
     */
    public function testPlayerConstruct()
    {
        $results = $this->player->getResults();
        $lastRoll = $this->player->getLastRoll();
//        $lastHand = $this->player->getLastHand();
        $sum = $this->player->getSumTotal();
        $average = $this->player->getAverage();

        $this->assertIsObject($this->player);
        $this->assertInstanceOf("daap19\Dice\Player", $this->player);

        /* Test Player attributes */
        $this->assertObjectHasAttribute("results", $this->player);
        $this->assertObjectHasAttribute("lastRoll", $this->player);
        $this->assertObjectHasAttribute("lastHand", $this->player);
        $this->assertObjectHasAttribute("sum", $this->player);
        $this->assertObjectHasAttribute("average", $this->player);
        $this->assertObjectHasAttribute("faces", $this->player);
        $this->assertObjectHasAttribute("dices", $this->player);

        /* Test property types */
        $this->assertIsArray($results);
        $this->assertIsArray($lastRoll);
//        $this->assertNull($lastHand);
        $this->assertIsInt($sum);
        $this->assertIsFloat($average);

        /* Test existence of expected class methods */
        $this->assertTrue(method_exists($this->player, "__construct"), "Class does not have expected method __construct.");
        $this->assertTrue(method_exists($this->player, "rollDices"), "Class does not have expected method rollDices.");
        $this->assertTrue(method_exists($this->player, "getResults"), "Class does not have expected method getResults.");
        $this->assertTrue(method_exists($this->player, "getSumTotal"), "Class does not have expected method getSumTotal.");
        $this->assertTrue(method_exists($this->player, "getLastRoll"), "Class does not have expected method getLastRoll.");
        $this->assertTrue(method_exists($this->player, "getDiceHand"), "Class does not have expected method getLastHand.");
        $this->assertTrue(method_exists($this->player, "getAverage"), "Class does not have expected method getAverage.");

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
        $diceHand = $this->player->rollDices(3, 6);
        $sum = $this->player->getSumTotal();

        $this->assertIsArray($diceHand);
        $this->assertCount(3, $diceHand);
        $this->assertIsInt($sum);
        $this->assertEquals(array_sum($diceHand), $sum);
    }


    /**
     * Test Player getResults method.
     */
    public function testPlayerResults()
    {
        $diceHand = $this->player->rollDices();
        $results = $this->player->getResults();

        $this->assertIsArray($diceHand);
        $this->assertIsArray($results);
        $this->assertEquals(array_sum($diceHand), array_sum($results));
    }


    /**
     * @description Test player getLastRoll() method.
     */
    public function testPlayerGetLastRoll()
    {
        $this->player->rollDices(6);
        $lastRoll = $this->player->getLastRoll();

        $this->assertCount(6, $lastRoll);
    }


    /**
     * @description Test player getLastHand() method.
     */
    public function testPlayerGetLastHand()
    {
        $this->player->rollDices(4);
        $lastHand = $this->player->getDiceHand();

        $this->assertIsObject($lastHand);
    }


    /**
     * @description Test player getAverage method.
     */
    public function testPlayerAverage()
    {
        $average = $this->player->getAverage();
        $this->assertIsFloat($average);
        $this->assertEquals(0, $average);

        $this->player->rollDices(6);
        $average = $this->player->getAverage();
        $this->assertIsFloat($average);
    }
}
