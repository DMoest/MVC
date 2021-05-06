<?php

declare(strict_types=1);

/**
 * Namespace for this module.
 */
namespace daap19\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

/* Use this namespace */
use daap19\Dice\Game; // Game class usage!

/**
 * Functions usage.
 */
use function Mos\Functions\{
//    destroySession,
    renderView,
    url
};


/**
 * @name DiceInit
 * @description Controller class for route to initializing a game of Dice, used by router.
 */
class DiceInit
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
            "message" => "Welcome, please setup a game of dice. 
                You choose the amout of players to be in it and the starting credit each player have. 
                Keep in mind that there will be an extra player added on top of the number you choose. 
                This player is played by the computer.",
            "action" => url("/dice/process"),
            "view" => "layout/dice__init.php",
//            "players" => intval($_POST["players"]) ?? null,
//            "credit" => intval($_POST["credit"]) ?? null,
//            "round" => $this->round,
//            "players" => $this->players,
//            "currentPlayer" => $this->getCurrentPlayer(),
//            "playerStopped" => $this->players[$this->playerIndex]->hasStopped(),
//            "playerNumber" => ($this->playerIndex +1),
        ];

        $body = renderView("layout/dice__init.php", $data);
        /* ------------------------------------------------------------ */

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    /**
     * @method processResponse()
     * @description method to process response object from POST action.
     * @return ResponseInterface as response object
     */
    public function processResponse(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();


        /* -------------------------------------------------- */

//        /* catch POST requests from form */
//        $_SESSION["startCredit"] = intval($_POST["credit"]) ?? null;
//        $_SESSION["players"] = intval($_POST["players"]) ?? null;

        /* create new game object with values from form */
        $diceGame = new Game($_SESSION["players"], $_SESSION["startCredit"], true);

        $_SESSION["diceGame"] = $diceGame;

        /* -------------------------------------------------- */



        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/dice__init/view"));
    }
}
