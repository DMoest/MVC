<?php

declare(strict_types=1);

/**
 * Namespace for this module.
 */
namespace daap19\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

/* Use this namespace */
//use daap19\Dice\Game; // Game class usage!

/**
 * Functions usage.
 */
use function Mos\Functions\{
    destroySession,
    renderView,
    url
};


/**
// * @name Game
 * @description Controller class for initializing a game of Dice, used by router.
 */
class Game
{
    /**
     * @method renderView()
     * @description renders view and returns response object for route controller class.
     * @return ResponseInterface as response object
     */
    public function renderView(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        /* - My code -------------------------------------------------- */
        $data = [
            "header" => "Dice Game 21",
            "message" => "Game on, roll them dices!",
            "action" => url("/dice/process"),
            "output" => $_SESSION["output"] ?? null,
            "players" => $_SESSION["players"] ?? null,
            "startCredit" => $_SESSION["startCredit"] ?? null,
            "view" => "layout/dice.php",
        ];

        $body = renderView($data["view"], $data);
        /* ------------------------------------------------------------ */

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    /**
     * @method processResponse()
     * @description method to process POST action to return response object.
     * @return ResponseInterface as response object
     */
    public function processResponse(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();


        /* -------------------------------------------------- */

        /* Catch POST request from dice__init form and store values to SESSION variable */
        $_SESSION["players"] = intval($_POST["players"]) ?? null;
        $_SESSION["startCredit"] = intval($_POST["credit"]) ?? null;
        $_SESSION["machine"] = intval($_POST["machine"]) ?? null;

        /* Create new Game object on SESSION variable */
        $_SESSION["diceGame"] = new Game($_SESSION["players"], $_SESSION["startCredit"], $_SESSION["machine"]);

        /* -------------------------------------------------- */


        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/dice/view"));
    }
}
