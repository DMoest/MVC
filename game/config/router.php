<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;


$router = $router ?? null;

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



/* Controller Class Routes */
/* -------------------------------------------------- */
/* Check these things:
    1. Route to respond on.
    2. Method in use for route (GET/POST).
    3. Usage route addon URL.
    4. Controller-Class used for route.
    5. Method of the Controller-Class to execute with.
*/


$router->addGroup("/dice__init", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\DiceInit", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\DiceInit", "processResponse"]);
});

$router->addGroup("/dice", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\Game", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\Game", "processResponse"]);
});

$router->addGroup("/dice__results", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\daap19\Controller\Dice", "renderView"]);
    $router->addRoute("POST", "/process", ["\daap19\Controller\Dice", "processResponse"]);
});

/* -------------------------------------------------- */
