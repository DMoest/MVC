<?php

declare(strict_types=1);

namespace daap19\Controller;

use PHPUnit\Framework\TestCase;
//use Psr\Http\Message\ResponseInterface;
//use Webmozart\Assert\Assert;
//use function Mos\Functions\renderView;

/**
 * Test cases for the controller Session.
 */
class ControllerDiceGameResultsTest extends TestCase
{
    protected object $diceGameResultsController;
    protected object $diceGameObject;


    /**
     * @description setUp for test suit. Each test case will run this at first.
     */
    final protected function setUp(): void
    {
        $this->diceGameObject = new \daap19\Dice\DiceGame(2, 25, false);
        $this->diceGameResultsController = new DiceGameResults();
        $this->diceGameObject->playGame(2, "roll"); // For results to show a diceHand must be played first.

        $_SESSION["diceGame"] = $this->diceGameObject;
    }


    /**
     * @description tearDown for test suit. Each test case will run this when done is done.
     */
    final protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }


    /**
     * @description Test new DiceGameResults object.
     */
    final public function testDiceGameResultsObject(): void
    {
        /* Test type and namespace existence */
        $this->assertIsObject($this->diceGameResultsController);
        $this->assertInstanceOf("daap19\Controller\DiceGameResults", $this->diceGameResultsController);

        /* Test if class have expected methods */
        $this->assertTrue(method_exists($this->diceGameResultsController, "renderView"), "Class does not have expected method renderView.");
        $this->assertTrue(method_exists($this->diceGameResultsController, "processResponse"), "Class does not have expected method processResponse.");
    }


    /**
     * @description Test new DiceGameResults controller object renderView response.
     */
    final public function testDiceGameResultsMethodRenderView(): void
    {
        /* Setup test case */
        $expected = "\Psr\Http\Message\ResponseInterface";
        $renderResponse = $this->diceGameResultsController->renderView();

        /* Test type and namespace existence */
        $this->assertIsObject($renderResponse);
        $this->assertInstanceOf($expected, $renderResponse);

        /* Test response object attributes existence */
        $this->assertObjectHasAttribute("reasonPhrase", $renderResponse);
        $this->assertObjectHasAttribute("statusCode", $renderResponse);
        $this->assertObjectHasAttribute("headers", $renderResponse);
        $this->assertObjectHasAttribute("headerNames", $renderResponse);
        $this->assertObjectHasAttribute("protocol", $renderResponse);
        $this->assertObjectHasAttribute("stream", $renderResponse);
    }


    /**
     * @description Test DiceGameResults controller object response from renderView to contain status code 200.
     */
    final public function testDiceGameResultsMethodRenderViewResponseStatusCode(): void
    {
        /* Setup test case */
        $renderResponse = $this->diceGameResultsController->renderView();
        $statusCode = $renderResponse->getStatusCode();

        /* Test case assertions */
        $this->assertIsInt($statusCode);
        $this->assertEquals(200, $statusCode);
    }


    /**
     * @description Test DiceGameResults controller object response from renderView to contain expected reason phrase.
     */
    final public function testDiceGameResultsMethodRenderViewResponseReasonPhrase(): void
    {
        $renderResponse = $this->diceGameResultsController->renderView();
        $reasonPhrase = $renderResponse->getReasonPhrase();

        /* Test case assertions */
        $this->assertIsString($reasonPhrase);
        $this->assertEquals("OK", $reasonPhrase);
    }


    /**
     * @description Test DiceGameResults controller method processResponse object to contain status code 301.
     * Player stopped to reach if-statement in tested method.
     */
    final public function testDiceGameResultsMethodProcessResponsePlayerStop(): void
    {
        /* Setup test case */

        $players = $this->diceGameObject->getPlayers();
        $player = $players[$this->diceGameObject->getPlayerIndex()];
        $player->stop();
        $stopped = $player->hasStopped();
        $this->diceGameResultsController->processResponse();

        /* Test case assertions */
        $this->assertIsBool($stopped);
        $this->assertEquals(true, $stopped);
    }


    /**
     * @description Test DiceGameResults controller method processResponse object to contain status code 301.
     * Player stopped to reach if-statement in tested method.
     */
    final public function testDiceGameResultsMethodProcessResponsePlayerBust(): void
    {
        /* Setup test case */
        $players = $this->diceGameObject->getPlayers();
        $player = $players[$this->diceGameObject->getPlayerIndex()];
        $player->setBust();
        $bust = $player->isBust();
        $this->diceGameResultsController->processResponse();

        /* Test case assertions */
        $this->assertIsBool($bust);
        $this->assertEquals(true, $bust);
    }


    /**
     * @description Test DiceGameResults controller method processResponse object to contain status code 301.
     * Player stopped to reach if-statement in tested method.
     */
    final public function testDiceGameResultsMethodProcessResponseLastPlayerStopped(): void
    {
        /* Setup test case */
        $this->diceGameObject->setNextPlayerIndex();
        $players = $this->diceGameObject->getPlayers();
        $playerIndex = $this->diceGameObject->getPlayerIndex();
        $player = $players[$playerIndex];
        $player->stop();
        $stopped = $player->hasStopped();
        $this->diceGameResultsController->processResponse();
        $lastIndex = array_key_last($players);

        /* Test case assertions */
        $this->assertIsBool($stopped);
        $this->assertEquals(true, $stopped);
        $this->assertEquals($lastIndex, $playerIndex);
    }


    /**
     * @description Test DiceGameResults controller method processResponse redirect path.
     */
    final public function testDiceGameResultsMethodProcessResponseRedirecPath(): void
    {
        /* Setup test case */
        $basePath = "://vendor/bin/";
        $processedResponse = $this->diceGameResultsController->processResponse();
        $headers = $processedResponse->getHeaders();
        $redirectPath = $headers["Location"][0];

        /* Test case assertions */
        $this->assertIsIterable($headers);
        $this->assertIsArray($headers);
        $this->assertArrayHasKey('Location', $headers);
        $this->assertArrayHasKey(0, $headers['Location']);
        $this->assertIsString($redirectPath);
        $this->assertEquals($basePath . "dice/view", $redirectPath);
    }
}
