<?php

declare(strict_types=1);

namespace daap19\Controller;

use PHPUnit\Framework\TestCase;
//use Psr\Http\Message\ResponseInterface;
//use Webmozart\Assert\Assert;
//use function Mos\Functions\renderView;

/**
 * Test cases for the controller class YatzyResults.
 */
class ControllerYatzyResultsTest extends TestCase
{
    protected object $yatzyObject;
    protected object $yatzyController;


    /**
     * @description setUp for test suit. Each test case will run this at first.
     * @noinspection GlobalVariableUsageInspection
     */
    final protected function setUp(): void
    {
        $this->yatzyObject = new \daap19\Yatzy\Yatzy();
        $this->yatzyController = new YatzyResults();

        $_SESSION["yatzy"] = $this->yatzyObject;
    }


    /**
     * @description tearDown for test suit. Each test case will run this when done is done.
     */
    final protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }


    final public function setupRollThreeTimes(): int
    {
        $players = $this->yatzyObject->getPlayers();
        $player = $players[$this->yatzyObject->getPlayerIndex()];
        $player->rollDices();
        $player->rollDices();
        $player->rollDices();

        return $player->getRolls();
    }


    /**
     * @description Test new YatzyResults object.
     */
    final public function testYatzyResultsControllerObject(): void
    {
        /* Test type and namespace existence */
        $this->assertIsObject($this->yatzyController);
        $this->assertInstanceOf("daap19\Controller\YatzyResults", $this->yatzyController);

        /* Test if class have expected methods */
        $this->assertTrue(method_exists($this->yatzyController, "renderView"), "Class does not have expected method renderView.");
        $this->assertTrue(method_exists($this->yatzyController, "processResponse"), "Class does not have expected method processResponse.");
    }


    /**
     * @description Test new YatzyResults object.
     */
    final public function testYatzyResultsMethodRenderView(): void
    {
        /* Setup test case */
        $expected = "\Psr\Http\Message\ResponseInterface";
        $response = $this->yatzyController->renderView();

        /* Test type and namespace existence */
        $this->assertIsObject($response);
        $this->assertInstanceOf($expected, $response);

        /* Test response object attributes existence */
        $this->assertObjectHasAttribute("reasonPhrase", $response);
        $this->assertObjectHasAttribute("statusCode", $response);
        $this->assertObjectHasAttribute("headers", $response);
        $this->assertObjectHasAttribute("headerNames", $response);
        $this->assertObjectHasAttribute("protocol", $response);
        $this->assertObjectHasAttribute("stream", $response);
    }


    /**
     * @description Test response object to contain status code 301.
     */
    final public function testYatzyResultsMethodProcessResponseStatusCode(): void
    {
        /* Setup test case */
        $processedResponse = $this->yatzyController->processResponse();
        $statusCode = $processedResponse->getStatusCode();

        /* Test case assertions */
        $this->assertIsInt($statusCode);
        $this->assertEquals(301, $statusCode);
    }


    /**
     * @description Test YatzyResults controller method processResponse redirect path.
     */
    final public function testYatzyResultsMethodProcessResponseRedirecPath(): void
    {
        /* Setup test case */
        $basePath = "://vendor/bin/";
        $processedResponse = $this->yatzyController->processResponse();
        $headers = $processedResponse->getHeaders();
        $redirectPath = $headers["Location"][0];

        /* Test case assertions */
        $this->assertIsIterable($headers);
        $this->assertIsArray($headers);
        $this->assertArrayHasKey('Location', $headers);
        $this->assertIsString($redirectPath);
        $this->assertEquals($basePath . "yatzy/view", $redirectPath);
    }


    /**
     * @description Test YatzyResults controller method processResponse redirect path if player rolled 3 times.
     */
    final public function testYatzyResultsMethodProcessResponseRedirecPathSelectScores(): void
    {
        /* Setup test case */
        $rolls = $this->setupRollThreeTimes();
        $basePath = "://vendor/bin/";
        $processedResponse = $this->yatzyController->processResponse();
        $headers = $processedResponse->getHeaders();
        $redirectPath = $headers["Location"][0];

        /* Test case assertions */
        $this->assertIsIterable($headers);
        $this->assertIsArray($headers);
        $this->assertArrayHasKey('Location', $headers);
        $this->assertIsString($redirectPath);
        $this->assertEquals($basePath . "yatzy__selectScores/view", $redirectPath);
        $this->assertEquals(3, $rolls);
    }
}