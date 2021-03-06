<?php

declare(strict_types=1);


/**
 * Namespace declared and others in use.
 */
namespace daap19\UnitTests;
use daap19\Controller\YatzySelectScores;
use \daap19\Yatzy\Yatzy;
use PHPUnit\Framework\TestCase;


/**
 * Test suite for the controller class YatzySelectScores.
 */
class ControllerYatzySelectScoresTest extends TestCase
{
    protected object $yatzyObject;
    protected object $yatzyController;


    /**
     * @description setUp for test suit. Each test case will run this at first.
     * @noinspection GlobalVariableUsageInspection
     */
    final protected function setUp(): void
    {
        $this->yatzyObject = new Yatzy();
        $this->yatzyController = new YatzySelectScores();

        $_SESSION["yatzy"] = $this->yatzyObject;
    }


    /**
     * @description tearDown for test suit. Each test case will run this when done is done.
     */
    final protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }


    /**
     * @description Setter method to simulate user selection of dice value to save.
     */
    final public function setupUserScoreSelection(int $diceValue): void
    {
        $value = strval($diceValue -1);
        $_POST["scoreSelect"] = $value;
    }


    /**
     * @description Test new YatzySelectScores object.
     */
    final public function testYatzySelectScoresControllerObject(): void
    {
        /* Test type and namespace existence */
        $this->assertIsObject($this->yatzyController);
        $this->assertInstanceOf("daap19\Controller\YatzySelectScores", $this->yatzyController);

        /* Test if class have expected methods */
        $this->assertTrue(method_exists($this->yatzyController, "renderView"), "Class does not have expected method renderView.");
        $this->assertTrue(method_exists($this->yatzyController, "processResponse"), "Class does not have expected method processResponse.");
    }


    /**
     * @description Test new YatzySelectScores object.
     */
    final public function testYatzySelectScoresMethodRenderView(): void
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
    final public function testYatzySelectScoresMethodProcessResponseStatusCode(): void
    {
        /* Setup test case */
        $this->setupUserScoreSelection(1);
        $processedResponse = $this->yatzyController->processResponse();
        $statusCode = $processedResponse->getStatusCode();

        /* Test case assertions */
        $this->assertIsInt($statusCode);
        $this->assertEquals(301, $statusCode);
    }


    /**
     * @description Test YatzySelectScores controller method processResponse redirect path.
     */
    final public function testYatzySelectScoresMethodProcessResponseRedirecPath(): void
    {
        /* Setup test case */
        $this->setupUserScoreSelection(1);
        $processedResponse = $this->yatzyController->processResponse();
        $this->setupUserScoreSelection(2);
        $processedResponse = $this->yatzyController->processResponse();
        $this->setupUserScoreSelection(3);
        $processedResponse = $this->yatzyController->processResponse();
        $this->setupUserScoreSelection(4);
        $processedResponse = $this->yatzyController->processResponse();
        $this->setupUserScoreSelection(5);
        $processedResponse = $this->yatzyController->processResponse();
        $this->setupUserScoreSelection(6);
        $processedResponse = $this->yatzyController->processResponse();

        $basePath = "://vendor/bin/";
        $headers = $processedResponse->getHeaders();
        $redirectPath = $headers["Location"][0];

        /* Test case assertions */
        $this->assertIsIterable($headers);
        $this->assertIsArray($headers);
        $this->assertArrayHasKey('Location', $headers);
        $this->assertIsString($redirectPath);
        $this->assertEquals($basePath . "yatzy__finalResults/view", $redirectPath);
    }


    /**
     * @description Test YatzySelectScores controller method processResponse redirect path.
     */
    final public function testYatzySelectScoresMethodProcessResponseRedirecPathOnAllSavedScores(): void
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
}
