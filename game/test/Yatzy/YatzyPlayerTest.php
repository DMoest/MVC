<?php

declare(strict_types=1);

namespace daap19\Yatzy;

use daap19\Yatzy\YatzyPlayer;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for Dice class.
 */
class YatzyPlayerTest extends TestCase
{
    /**
     * @description Test YatzyPlayer object construct method.
     */
    final public function testYatzyPlayerConstruct()
    {
        $player = new YatzyPlayer();

        $this->assertIsObject($player);
        $this->assertInstanceOf("daap19\Yatzy\YatzyPlayer", $player);

        /* Test unique parent::class attributes */
        $this->assertObjectHasAttribute("lastHand", $player);

        /* Test YatzyPlayer attributes */
        $this->assertObjectHasAttribute("rolls", $player);
        $this->assertObjectHasAttribute("results", $player);
        $this->assertObjectHasAttribute("lastRoll", $player);
        $this->assertObjectHasAttribute("diceHand", $player);
        $this->assertObjectHasAttribute("lastHand", $player);
        $this->assertObjectHasAttribute("keepDices", $player);
        $this->assertObjectHasAttribute("sum", $player);
        $this->assertObjectHasAttribute("average", $player);
        $this->assertObjectHasAttribute("playerScores", $player);

        /* Test if class have expected methods */
        $this->assertTrue(method_exists($player, "rollDices"), "Class does not have expected method rollDices.");
        $this->assertTrue(method_exists($player, "getRolls"), "Class does not have expected method getRolls.");
        $this->assertTrue(method_exists($player, "getScore"), "Class does not have expected method getScore.");
        $this->assertTrue(method_exists($player, "getPlayerScore"), "Class does not have expected method getPlayerScore.");
        $this->assertTrue(method_exists($player, "getPlayerScore"), "Class does not have expected method getPlayerScore.");
        $this->assertTrue(method_exists($player, "getAmountOfScoresSaved"), "Class does not have expected method getAmountOfScoresSaved.");
        $this->assertTrue(method_exists($player, "getAmountOfScoresSaved"), "Class does not have expected method getAmountOfScoresSaved.");
        $this->assertTrue(method_exists($player, "getPlayerScoreSum"), "Class does not have expected method getPlayerScoreSum.");
        $this->assertTrue(method_exists($player, "getDiceHand"), "Class does not have expected method getDiceHand.");
        $this->assertTrue(method_exists($player, "keepDices"), "Class does not have expected method keepDices.");
        $this->assertTrue(method_exists($player, "stop"), "Class does not have expected method stop.");
        $this->assertTrue(method_exists($player, "hasStopped"), "Class does not have expected method hasStopped.");
        $this->assertTrue(method_exists($player, "saveScores"), "Class does not have expected method saveScores.");
        $this->assertTrue(method_exists($player, "setForNextRound"), "Class does not have expected method setForNextRound.");
    }


    /**
     * @description Test YatzyPlayer rollDices method.
     */
    final public function testYatzyPlayerRollDices(): void
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $rolledDices = $player->rollDices();

        /* Case Assertions */
        $this->assertIsIterable($rolledDices);
        $this->assertIsArray($rolledDices);
    }


    /**
     * @description Test YatzyPlayer getRolls method.
     */
    final public function testYatzyPlayerGetRolls(): void
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $player->rollDices();
        $player->rollDices();
        $player->rollDices();
        $rolls = $player->getRolls();

        /* Case Assertions */
        $this->assertIsInt($rolls);
        $this->assertEquals(3, $rolls);
    }


    /**
     * @description Test YatzyPlayer saveScores method with zero count of chosen value.
     */
    final public function testYatzyPlayerSaveScoresNoValue()
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $diceHand = [1, 2, 3, 4, 5];
        $player->saveScores($diceHand, 6);
        $savedScores = $player->getPlayerScore();

        /* Assert test case */
        $this->assertIsIterable($savedScores);
        $this->assertIsArray($savedScores);
        $this->assertNull($savedScores[0]);
        $this->assertNull($savedScores[1]);
        $this->assertNull($savedScores[2]);
        $this->assertNull($savedScores[3]);
        $this->assertNull($savedScores[4]);
        $this->assertIsInt($savedScores[5]);
        $this->assertEquals(0, $savedScores[5]);
    }


    /**
     * @description Test YatzyPlayer saveScores method.
     */
    final public function testYatzyPlayerSaveScoresMultiplesOfDiceValue()
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $diceHand = [1, 3, 3, 3, 5];
        $player->saveScores($diceHand, 3);
        $savedScores = $player->getPlayerScore();

        /* Assert test case */
        $this->assertIsIterable($savedScores);
        $this->assertIsArray($savedScores);
        $this->assertNull($savedScores[0]);
        $this->assertNull($savedScores[1]);
        $this->assertIsInt($savedScores[2]); // Here is the saved values
        $this->assertNull($savedScores[3]);
        $this->assertNull($savedScores[4]);
        $this->assertNull($savedScores[5]);
        $this->assertEquals(9, $savedScores[2]);
    }


    /**
     * @description Test YatzyPlayer getAmountOfSaveScores method.
     */
    final public function testYatzyPlayerGetAmountOfSavedScores()
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $diceHand = [1, 3, 3, 3, 5];
        $player->saveScores($diceHand, 3);
        $player->saveScores($diceHand, 5);
        $amountOfSavedScores = $player->getAmountOfScoresSaved();

        /* Assert test case */
        $this->assertIsInt($amountOfSavedScores);
        $this->assertEquals(2, $amountOfSavedScores);
    }


    /**
     * @description Test YatzyPlayer saveScoresSum method.
     */
    final public function testYatzyPlayerGetSavedScoresSum()
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $diceHand = [1, 4, 3, 4, 5];
        $player->saveScores($diceHand, 3);
        $player->saveScores($diceHand, 4);
        $savedScoresSum = $player->getPlayerScoreSum();

        /* Assert test case */
        $this->assertIsInt($savedScoresSum);
        $this->assertEquals(11, $savedScoresSum);
    }


    /**
     * @description Test YatzyPlayer getPlayerScores method.
     */
    final public function testYatzyPlayerGetPlayerScores(): void
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $diceHand = $player->rollDices();
        $referenceValue = $diceHand[0];
        $occurrence = 0;

        foreach ($diceHand as $diceValue) {
            if ($referenceValue === $diceValue) {
                $occurrence++;
            }
        }

        $player->saveScores($diceHand, $referenceValue);
        $savedScores = $player->getPlayerScore();

        /* Case Assertions */
        $this->assertIsIterable($savedScores);
        $this->assertIsArray($savedScores);
        $this->assertEquals($referenceValue, ($savedScores[$referenceValue-1] / $occurrence));
    }


    /**
     * @description Test YatzyPlayer getDiceHand method.
     */
    final public function testYatzyPlayerGetDiceHand(): void
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $player->rollDices();
        $diceHand = $player->getDiceHand();

        /* Case Assertions */
        $this->assertIsObject($diceHand);
    }


    /**
     * @description Test YatzyPlayer stop method.
     */
    final public function testYatzyPlayerStop(): void
    {
        /* Setup case */
        $player = new YatzyPlayer();
        $beforeStop = $player->hasStopped();
        $player->stop();
        $stopped = $player->hasStopped();

        /* Case Assertions */
        $this->assertIsBool($beforeStop);
        $this->assertFalse($beforeStop);
        $this->assertIsBool($stopped);
        $this->assertTrue($stopped);
    }


//    /**
//     * @description Test YatzyPlayer keepDices method.
//     */
//    final public function testYatzyPlayerKeepDices(): void
//    {
//        /* Setup case */
//        $player = new YatzyPlayer();
//
//        $lastRoll1 = $player->rollDices();
//        $dice1Before = $lastRoll1[1];
//        $dice2Before = $lastRoll1[2];
//        $keep = $player->keepDices([1, 2]);
//        $lastRoll2 = $player->rollDices();
//
//        $dice1After = $lastRoll2[1];
//        $dice2After = $lastRoll2[2];
//
//        /* Case Assertions */
//        $this->assertIsIterable($keep);
//        $this->assertIsArray($keep);
//
//        $this->assertIsInt($dice1Before);
//        $this->assertIsInt($dice1After);
//        $this->assertIsInt($dice2Before);
//        $this->assertIsInt($dice2Before);
//
//        $this->assertContains($dice1Before, $lastRoll2);
//        $this->assertContains($dice2Before, $lastRoll2);
//
//        $this->assertEquals($dice1Before, $dice1After);
//        $this->assertEquals($dice2Before, $dice2After);
//    }
}
