<?php

declare(strict_types=1);

namespace daap19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class DiceTest extends TestCase
{
    /**
     * @description Test construct method for Dice class. Test instance of namespace and test default value for property faces.
     */
    public function testDiceConstruct()
    {
        $dice = new Dice();

        /* Setup test case */
        $faces = $dice->getFaces();
        $results = $dice->getDiceResults();
        $lastRoll = $dice->getLastRoll();

        /* Test class object for namespace */
        $this->assertInstanceOf("daap19\Dice\Dice", $dice);

        /* Test class attributes existence */
        $this->assertObjectHasAttribute("faces", $dice);
        $this->assertObjectHasAttribute("diceResults", $dice);
        $this->assertObjectHasAttribute("lastRoll", $dice);

        /* Test class attributes type */
        $this->assertIsInt($faces);
        $this->assertIsArray($results);
        $this->assertNull($lastRoll);

        /* Test class attributes initial values */
        $this->assertEquals(6, $faces);
        $this->assertEmpty($results);

        /* Test existence of expected class methods */
        $this->assertTrue(method_exists($dice, "__construct"), "Class does not have expected method __construct.");
        $this->assertTrue(method_exists($dice, "roll"), "Class does not have expected method roll.");
        $this->assertTrue(method_exists($dice, "getFaces"), "Class does not have expected method getFaces.");
        $this->assertTrue(method_exists($dice, "getLastRoll"), "Class does not have expected method getLastRoll.");
        $this->assertTrue(method_exists($dice, "getDiceResults"), "Class does not have expected method getDiceResults.");
    }


    /**
     * @description Test dice roll method. Test dice value for type integer.
     */
    public function testDiceGetFaces()
    {
        $dice = new Dice(3);
        $diceFaces = $dice->getFaces();

        $this->assertIsInt($diceFaces);
        $this->assertEquals(3, $diceFaces);
    }


    /**
     * @description Test dice roll method. Test dice value for type integer.
     */
    public function testDiceRoll()
    {
        $dice = new Dice();
        $diceValue = $dice->roll();

        $this->assertIsInt($diceValue);
    }


    /**
     * @description Test dice getLastRoll method. Test dice value for type integer.
     */
    public function testDiceGetLastRoll()
    {
        $dice = new Dice();
        $dice->roll();
        $diceValue = $dice->getLastRoll();

        $this->assertIsInt($diceValue);
    }


    /**
     * @method testGetDiceResults()
     * @description Test dice method getDiceResults. Roll the dice three times, assert each value for type, assert dice results for type and assert each rolled value is contained i dice results.
     */
    public function testGetDiceResults()
    {
        $dice = new Dice();

        $diceValue1 = $dice->roll();
        $this->assertIsInt($diceValue1);

        $diceValue2 = $dice->roll();
        $this->assertIsInt($diceValue2);

        $diceValue3 = $dice->roll();
        $this->assertIsInt($diceValue3);

        $diceResults = $dice->getDiceResults();
        $this->assertIsArray($diceResults);
        $this->assertContains($diceValue1, $diceResults);
        $this->assertContains($diceValue2, $diceResults);
        $this->assertContains($diceValue3, $diceResults);
    }
}
