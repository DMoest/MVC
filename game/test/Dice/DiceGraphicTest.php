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
        $dice = new DiceGraphic();

        $this->assertIsObject($dice);
        $this->assertInstanceOf("daap19\Dice\DiceGraphic", $dice);
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
