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
class ControllerDiceGameTest extends TestCase
{
    protected object $diceGameController;
    protected object $diceGameObject;


    /**
     * @description setUp for test suit. Each test case will run this at first.
     */
    final protected function setUp(): void
    {
        $this->diceGameObject = new \daap19\Dice\DiceGame(2, 25, false);
        $this->diceGameController = new DiceGame();

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
     * @description Setup for test case dependencies to $_POST variable attributes "dices" and "submit" for replicating user action.
     */
    final public function setupDicesAndSubmit(): void
    {
        $_POST["dices"] = 2;
        $_POST["submit"] = "roll";
    }


    /**
     * @description Test new DiceGame object.
     */
    final public function testDiceGameObject(): void
    {
        /* Test type and namespace existence */
        $this->assertIsObject($this->diceGameController);
        $this->assertInstanceOf("daap19\Controller\DiceGame", $this->diceGameController);

        /* Test if class have expected methods */
        $this->assertTrue(method_exists($this->diceGameController, "renderView"), "Class does not have expected method renderView.");
        $this->assertTrue(method_exists($this->diceGameController, "processResponse"), "Class does not have expected method processResponse.");
    }


    /**
     * @description Test new DiceGame controller object renderView response.
     */
    final public function testDiceGameMethodRenderView(): void
    {
        /* Setup test case */
        $expected = "\Psr\Http\Message\ResponseInterface";
        $renderResponse = $this->diceGameController->renderView();

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
     * @description Test DiceGame controller object response from renderView to contain status code 200.
     */
    final public function testDiceGameMethodRenderViewResponseStatusCode(): void
    {
        /* Setup test case */
        $renderResponse = $this->diceGameController->renderView();
        $statusCode = $renderResponse->getStatusCode();

        /* Test case assertions */
        $this->assertIsInt($statusCode);
        $this->assertEquals(200, $statusCode);
    }


    /**
     * @description Test DiceGame controller object response from renderView to contain expected reason phrase.
     */
    final public function testDiceGameMethodRenderViewResponseReasonPhrase(): void
    {
        $renderResponse = $this->diceGameController->renderView();
        $reasonPhrase = $renderResponse->getReasonPhrase();

        /* Test case assertions */
        $this->assertIsString($reasonPhrase);
        $this->assertEquals("OK", $reasonPhrase);
    }


    /**
     * @description Test DiceGame controller method processResponse object to contain status code 301.
     * Machine set to null to reach if-statement in tested method.
     */
    final public function testDiceGameMethodProcessResponseStatusCodeNoMachine(): void
    {
        /* Setup test case */
        $this->setupDicesAndSubmit();
        $processedResponse = $this->diceGameController->processResponse();
        $statusCode = $processedResponse->getStatusCode();

        /* Test case assertions */
        $this->assertIsInt($statusCode);
        $this->assertEquals(301, $statusCode);
    }


    /**
     * @description Test DiceGame controller method processResponse redirect path.
     */
    final public function testDiceGameMethodProcessResponseRedirecPath(): void
    {
        /* Setup test case */
        $basePath = "://vendor/bin/";
        $this->setupDicesAndSubmit();
        $processedResponse = $this->diceGameController->processResponse();
        $headers = $processedResponse->getHeaders();
        $redirectPath = $headers["Location"][0];

        /* Test case assertions */
        $this->assertIsIterable($headers);
        $this->assertIsArray($headers);
        $this->assertArrayHasKey('Location', $headers);
        $this->assertArrayHasKey(0, $headers['Location']);
        $this->assertIsString($redirectPath);
        $this->assertEquals($basePath . "dice__results/view", $redirectPath);
    }
}