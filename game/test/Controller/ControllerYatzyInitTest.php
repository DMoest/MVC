<?php

declare(strict_types=1);

namespace daap19\Controller;

use PHPUnit\Framework\TestCase;
//use Psr\Http\Message\ResponseInterface;
//use Webmozart\Assert\Assert;
//use function Mos\Functions\renderView;

/**
 * Test cases for the controller class YatzyInit.
 */
class ControllerYatzyInitTest extends TestCase
{
    protected object $yatzyObject;


    /**
     * @description setUp for test suit. Each test case will run this at first.
     */
    final protected function setUp(): void
    {
        $this->yatzyObject = new YatzyInit();
    }


    /**
     * @description tearDown for test suit. Each test case will run this when done is done.
     */
    final protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }


    final public function setupYatzySession(): void
    {
        $_SESSION["yatzy"] = $this->yatzyObject;
    }


    /**
     * @description Test new YatzyInit object.
     */
    final public function testYatzyInitObject(): void
    {
        /* Test type and namespace existence */
        $this->assertIsObject($this->yatzyObject);
        $this->assertInstanceOf("daap19\Controller\YatzyInit", $this->yatzyObject);

        /* Test if class have expected methods */
        $this->assertTrue(method_exists($this->yatzyObject, "renderView"), "Class does not have expected method renderView.");
        $this->assertTrue(method_exists($this->yatzyObject, "processResponse"), "Class does not have expected method processResponse.");
    }


    /**
     * @description Test new YatzyInit object.
     */
    final public function testYatzyInitMethodRenderView(): void
    {
        /* Setup test case */
        $expected = "\Psr\Http\Message\ResponseInterface";
        $response = $this->yatzyObject->renderView();

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
     * @description Test new YatzyInit object.
     */
    final public function testYatzyInitMethodRenderViewSessionStarted(): void
    {
        /* Setup test case */
        $expected = "\Psr\Http\Message\ResponseInterface";
        $this->setupYatzySession();
        $response = $this->yatzyObject->renderView();

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
    final public function testYatzyInitMethodProcessResponseStatusCode(): void
    {
        /* Setup test case */
        $processedResponse = $this->yatzyObject->processResponse();
        $statusCode = $processedResponse->getStatusCode();

        /* Test case assertions */
        $this->assertIsInt($statusCode);
        $this->assertEquals(301, $statusCode);
    }


    /**
     * @description Test YatzyInit controller method processResponse redirect path.
     */
    final public function testYatzyInitMethodProcessResponseRedirecPath(): void
    {
        /* Setup test case */
        $basePath = "://vendor/bin/";
        $processedResponse = $this->yatzyObject->processResponse();
        $headers = $processedResponse->getHeaders();
        $redirectPath = $headers["Location"][0];

        /* Test case assertions */
        $this->assertIsIterable($headers);
        $this->assertIsArray($headers);
        $this->assertArrayHasKey('Location', $headers);
        $this->assertIsString($redirectPath);
        $this->assertEquals($basePath . "yatzy/view", $redirectPath);
        $this->assertNotEmpty($_SESSION["yatzy"]);
    }
}
