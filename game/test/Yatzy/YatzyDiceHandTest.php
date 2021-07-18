<?php

declare(strict_types=1);

namespace daap19\Yatzy;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class YatzyDiceHandTest extends TestCase
{
    /**
     * @description Test construct method for YatzyDiceHand class.
     */
    final public function testYatzyDiceHandConstruct(): void
    {
        /* Setup test case */
        $diceHand = new YatzyDiceHand();

        /* Test class object for namespace */
        $this->assertIsObject($diceHand);
        $this->assertInstanceOf("daap19\Yatzy\YatzyDiceHand", $diceHand);

        /* Test class attributes existence */
        $this->assertObjectHasAttribute("keepDices", $diceHand);

        /* Test existence of expected class methods */
        $this->assertTrue(method_exists($diceHand, "__construct"), "Class does not have expected method __construct.");
        $this->assertTrue(method_exists($diceHand, "roll"), "Class does not have expected method roll.");
        $this->assertTrue(method_exists($diceHand, "keepDices"), "Class does not have expected method keepDices.");
        $this->assertTrue(method_exists($diceHand, "clearKeptDices"), "Class does not have expected method clearKeptDices.");
        $this->assertTrue(method_exists($diceHand, "getKeptDices"), "Class does not have expected method getKeptDices.");
        $this->assertTrue(method_exists($diceHand, "setForNextRound"), "Class does not have expected method setForNextRound.");
    }


    /**
     * @description Test YatzyDiceHand method roll without kept dices.
     */
    final public function testYatzyDiceHandRollNoKeep(): void
    {
        /* setup test case */
        $diceHand = new YatzyDiceHand();
        $lastRoll = $diceHand->roll();

        /* Test method return value */
        $this->assertIsIterable($lastRoll);
        $this->assertIsArray($lastRoll);
        $this->assertNotEmpty($lastRoll);
    }


    /**
     * @description Test YatzyDiceHand method roll with kept dices.
     */
    final public function testYatzyDiceHandRollKeptDices(): void
    {
        /* setup test case */
        $diceHand = new YatzyDiceHand();
        $lastRoll = $diceHand->roll();
        $keepers = $diceHand->keepDices([1, 4]);
        $newLastRoll = $diceHand->roll();

        /* Test method return value */
        $this->assertIsIterable($lastRoll);
        $this->assertIsIterable($newLastRoll);
        $this->assertIsArray($lastRoll);
        $this->assertIsArray($newLastRoll);
        $this->assertNotEmpty($lastRoll);

        foreach ($newLastRoll as $diceValue) {
            $this->assertIsInt($diceValue);
        }

        /* Test same value of old and new */
        $this->assertSame($newLastRoll[1], $lastRoll[1]);
        $this->assertSame($newLastRoll[4], $lastRoll[4]);
    }


    /**
     * @description Test YatzyDiceHand method clearKeptDices.
     */
    final public function testYatzyDiceHandClearKeptDices(): void
    {
        $diceHand = new YatzyDiceHand();

        /* setup test case */
        $lastRoll = $diceHand->roll();
        $keepers = $diceHand->keepDices([1, 4]);
        $diceHand->clearKeptDices();
        $noKeepers = $diceHand->getkeptDices();

        /* Test method return value */
        $this->assertIsIterable($lastRoll);
        $this->assertIsIterable($noKeepers);
        $this->assertIsArray($keepers);
        $this->assertIsArray($noKeepers);
        $this->assertNotEmpty($keepers);
        $this->assertEmpty($noKeepers);
        $this->assertNotSame($keepers, $noKeepers);
    }


    /**
     * @description Test YatzyDiceHand method setForNextRound.
     */
    final public function testYatzyDiceHandSetForNextRound(): void
    {
        $diceHand = new YatzyDiceHand();

        /* setup test case */
        $lastRoll = $diceHand->roll();
        $keepers = $diceHand->keepDices([1, 4]);
        $diceHand->setForNextRound();
        $noLastRoll = $diceHand->getLastRoll();
        $noKeepers = $diceHand->getkeptDices();

        /* Test method return value */
        $this->assertIsIterable($lastRoll);
        $this->assertIsIterable($noLastRoll);
        $this->assertIsIterable($noKeepers);
        $this->assertIsIterable($keepers);
        $this->assertIsArray($lastRoll);
        $this->assertIsArray($noLastRoll);
        $this->assertIsArray($keepers);
        $this->assertIsArray($noKeepers);
        $this->assertNotEmpty($keepers);
        $this->assertEmpty($noKeepers);
        $this->assertNotSame($keepers, $noKeepers);
    }
}
