<?php

declare(strict_types=1);

/**
 * Namespace for this module.
 */
namespace daap19\Controller;

use Mos\Controller\ControllerBase;
use Psr\Http\Message\ResponseInterface;
//use Nyholm\Psr7\Factory\Psr17Factory;

/**
 * Functions usage.
 */
use function Mos\Functions\{
//    destroySession,
    renderView,
    url
};


/**
 * @name DiceGame
 * @description Controller class for initializing a game of Dice, used by router.
 */
class DiceGame extends ControllerBase
{
    protected object $diceGame;
    protected string $scoreBoard;


    /**
     * @method renderView()
     * @description renders view and returns response object for route controller class.
     * @return ResponseInterface
     */
    public function renderView(): ResponseInterface
    {
        $diceGame = $_SESSION["diceGame"];
        $players = $diceGame->getPlayers();
        $currentPlayer = $players[$diceGame->getPlayerIndex()];

        $data = [
            "header" => "Dice DiceGame 21",
            "message" => "DiceGame on, roll them dices!",
            "action" => url("/dice/process"),
            "round" => $diceGame->getRound(),
            "players" => $diceGame->getPlayers(),
            "score" => $currentPlayer->getScore(),
            "credit" => $currentPlayer->getCredit(),
            "numberOfPlayers" => count($diceGame->getPLayers()),
            "playerNumber" => $diceGame->getPlayerIndex() +1,
            "scoreBoard" => $diceGame->printDiceScoreBoard(),
        ];

        $body = renderView("layout/dice.php", $data);

        // Return the response through parent class ControllerBase
        return $this->response($body);
    }


    /**
     * @method processResponse()
     * @description method to process POST action to return response object.
     * @return ResponseInterface
     */
    public function processResponse(): ResponseInterface
    {
        $diceGame = $_SESSION["diceGame"];

        /* Catch POST request from dice__init form and store values to SESSION variable */
        $dices = intval($_POST["dices"]) ?? null;
        $submit = strval($_POST["submit"]) ?? null;

        /* Play game */
        $diceGame->playGame($dices, $submit);
        $this->scoreBoard = $diceGame->printDiceScoreBoard();

        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/dice__results/view"));
    }
}
