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
        $faces = $dice->getFaces();

        $this->assertInstanceOf("daap19\Dice\Dice", $dice);
        $this->assertEquals(6, $faces);
    }


    /**
     * @description Test dice roll method. Test dice value for type integer.
     */
    public function testDiceGetFaces()
    {
        $dice = new Dice();
        $diceFaces = $dice->getFaces();

        $this->assertIsInt($diceFaces);
        $this->assertEquals(6, $diceFaces);
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
