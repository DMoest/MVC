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
        $playerScore = $currentPlayer->getScore();
        $playerCredit = $currentPlayer->getCredit();

        $data = [
            "header" => "Dice DiceGame 21",
            "message" => "DiceGame on, roll them dices!",
            "action" => url("/dice/process"),
            "round" => $diceGame->getRound(),
            "players" => $players,
            "score" => $playerScore,
            "credit" => $playerCredit,
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
        /* Catch POST request from dice__init form and store values to SESSION variable */
        $diceGame = $_SESSION["diceGame"];
        $dices = intval($_POST["dices"]) ?? null;
        $submit = strval($_POST["submit"]) ?? null;

        /* Play game */
        $diceGame->playGame($dices, $submit);
        $this->scoreBoard = $diceGame->printDiceScoreBoard();

        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/dice__results/view"));
    }


    /**
     * @name reset
     * @description method to reset game through removing the variable from the session.
     * @return ResponseInterface
     */
    public function reset(): ResponseInterface
    {
        /* Removes the session variable that is diceGame to */
        unset($_SESSION["diceGame"]);

        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/dice__init/view"));
    }
}
