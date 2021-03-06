<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);


use FastRoute\RouteCollector;


$router = $router ?? new RouteCollector(
    new \FastRoute\RouteParser\Std(),
    new \FastRoute\DataGenerator\MarkBased()
);


/* - Example Routes ----------------------------------------------- */

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});

$router->addGroup("/form", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\Mos\Controller\Form", "view"]);
    $router->addRoute("POST", "/process", ["\Mos\Controller\Form", "process"]);
});


/* - DICE 21 ----------------------------------------------- */

$router->addGroup("/dice__init", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\DiceInit", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\DiceInit", "processResponse"]);
});

$router->addGroup("/dice", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\DiceGameController", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\DiceGameController", "processResponse"]);
    $router->addRoute("POST", "/reset", ["\daap19\Controller\DiceGameController", "reset"]);
});

$router->addGroup("/dice__results", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\DiceGameResults", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\DiceGameResults", "processResponse"]);
});

$router->addGroup("/dice__finalResults", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\DiceGameFinalResults", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\DiceGameFinalResults", "processResponse"]);
});


/* - YATZY ------------------------------------------------- */

$router->addGroup("/yatzy__init", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\YatzyInit", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\YatzyInit", "processResponse"]);
});

$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\YatzyController", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\YatzyController", "processResponse"]);
    $router->addRoute("POST", "/reset", ["\daap19\Controller\YatzyController", "reset"]);
});

$router->addGroup("/yatzy__results", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\YatzyResults", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\YatzyResults", "processResponse"]);
});

$router->addGroup("/yatzy__selectScores", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\YatzySelectScores", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\YatzySelectScores", "processResponse"]);
});

$router->addGroup("/yatzy__finalResults", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\YatzyFinalResults", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\YatzyFinalResults", "processResponse"]);
});

/* -------------------------------------------------- */
