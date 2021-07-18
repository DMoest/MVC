<?php

declare(strict_types=1);

namespace daap19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * @description Test DiceGraphic construct method.
     */
    public function testDiceGraphicConstruct()
    {
        /* Setup test case */
        $dice = new DiceGraphic();

        /* Test class object for namespace & type */
        $this->assertInstanceOf("daap19\Dice\DiceGraphic", $dice);
        $this->assertIsObject($dice);

        /* Test class attributes existence */
        $this->assertObjectHasAttribute("SIDES", $dice);

        /* Test existence of expected class methods */
        $this->assertTrue(method_exists($dice, "__construct"), "Class does not have expected method __construct.");
        $this->assertTrue(method_exists($dice, "graphicDice"), "Class does not have expected method graphicDice.");
    }

    /**
     * @description Test DiceGraphic graphicDice() method.
     */
    public function testDiceGraphicPrintMethod()
    {
        $dice = new DiceGraphic();

        $dice->roll();
        $graphicDice = $dice->graphicDice();
        $this->assertIsString($graphicDice);
    }
}
