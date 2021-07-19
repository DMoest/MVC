<?php

declare(strict_types=1);

namespace daap19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class DiceHandTest extends TestCase
{
    /**
     * @description Test construct method for DiceHand class.
     */
    final public function testDiceHandConstruct(): void
    {
        $diceHand = new DiceHand();

        /* Setup test case */
        $dices = $diceHand->getDices();
        $lastRoll = $diceHand->getLastRoll();
        $sum = $diceHand->getSum();
        $average = $diceHand->getAverage();

        /* Test class object for namespace */
        $this->assertInstanceOf("daap19\Dice\DiceHand", $diceHand);

        /* Test class attributes existence */
        $this->assertObjectHasAttribute("faces", $diceHand);
        $this->assertObjectHasAttribute("dices", $diceHand);
        $this->assertObjectHasAttribute("numberOfDices", $diceHand);
        $this->assertObjectHasAttribute("lastRoll", $diceHand);
        $this->assertObjectHasAttribute("sum", $diceHand);
        $this->assertObjectHasAttribute("average", $diceHand);

        /* Test class attributes type */
        $this->assertIsArray($dices);
        $this->assertIsIterable($dices);
        $this->assertIsArray($lastRoll);
        $this->assertIsIterable($lastRoll);
        $this->assertIsInt($sum);
        $this->assertIsFloat($average);

        /* Test class attributes initial values */
        $this->assertCount(1, $dices);
        $this->assertEquals(0, $sum);
        $this->assertEquals(0, $average);

        foreach ($dices as $dice) {
            $faces = $dice->getFaces();
            $this->assertIsInt($faces);
            $this->assertEquals(6, $faces);
        }
    }


    /**
     * @description Test DiceHand method getDices.
     */
    final public function testDiceHandGetDices(): void
    {
        /* Setup test case */
        $diceHand = new DiceHand();
        $diceHand2 = new DiceHand(13);
        $dices = $diceHand->getDices();
        $dices2 = $diceHand2->getDices();

        /* Test class method return types */
        $this->assertIsIterable($dices);
        $this->assertIsIterable($dices2);

        /* Test class method return values */
        $this->assertCount(1, $dices);
        $this->assertCount(13, $dices2);
        $this->assertNotSame($diceHand, $diceHand2);
        $this->assertNotSame($dices, $dices2);
    }


    /**
     * @description 
     */
    final public function testDiceHandRoll(): void
    {
        $diceHand = new DiceHand();

        $diceHandRoll = $diceHand->roll();
        $this->assertIsArray($diceHandRoll);
        $this->assertIsInt($diceHandRoll[0]);
    }


    /**
     * @description Test DiceHand getLastRoll method.
     */
    final public function testDiceHandLastRoll(): void
    {
        $diceHand = new DiceHand();
        $diceHand->roll();
        $dices = $diceHand->getLastRoll();
        $this->assertCount(1, $dices);
        $this->assertIsInt($dices[0]);

        $diceHand = new DiceHand(4);
        $diceHand->roll();
        $dices = $diceHand->getLastRoll();
        $this->assertCount(4, $dices);

        $diceHandSum = array_sum($dices);
        $this->assertIsInt($diceHandSum);
    }


    /**
     * @description Test case for DiceHand getLastRollAsString() method.
     */
    final public function testDiceHandLastRollAsString(): void
    {
        $diceHand = new DiceHand();

        $diceHand->roll();
        $diceHand->roll();
        $diceHand->roll();
        $lastRollAsStr = $diceHand->getLastRollAsString();
        $this->assertIsString($lastRollAsStr);
    }


    /**
     * @description Test case for DiceHand getSum() method.
     */
    final public function testDiceHandSum(): void
    {
        $diceHand = new DiceHand();

        $sum = $diceHand->getSum();
        $this->assertEquals(0, $sum);

        $diceHand->roll();
        $diceHandValues = $diceHand->getLastRoll();
        $sum = $diceHand->getSum();

        $this->assertEquals($diceHandValues[0], $sum);
    }


    /**
     * @description Test case for DiceHand getAverage() method.
     */
    final public function testDiceHandAverage(): void
    {
        $diceHand = new DiceHand();

        $average = $diceHand->getAverage();
        $this->assertEquals(0, $average);

        $diceHand->roll();
        $lastRoll = $diceHand->getLastRoll();
        $average = $diceHand->getAverage();
        $this->assertEquals(array_sum($lastRoll), $average);
    }
}
