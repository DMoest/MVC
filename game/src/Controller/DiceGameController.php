<?php

declare(strict_types=1);

/**
 * Namespace for this module.
 */
namespace daap19\Controller;
use Mos\Controller\ControllerBase;
use Psr\Http\Message\ResponseInterface;


/**
 * Functions usage.
 */
use function Mos\Functions\{
//    destroySession,
    renderView,
    url
};


/**
 * @name DiceGameController
 * @description Controller class for initializing a game of Dice, used by router.
 */
class DiceGameController extends ControllerBase
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
        $this->diceGame = $_SESSION["diceGame"];
        $players = $this->diceGame->getPlayers();
        $playerIndex = $this->diceGame->getPlayerIndex();
        $player = $players[$playerIndex];
        $credit = $player->getCredit();

        $data = [
            "header" => "Dice DiceGame 21",
            "message" => "DiceGame on, roll them dices!",
            "action" => url("/dice/process"),
            "round" => $this->diceGame->getRound(),
            "players" => $this->diceGame->getPlayers(),
            "score" => $player->getSumTotal(),
            "credit" => $credit,
            "numberOfPlayers" => count($this->diceGame->getPLayers()),
            "playerNumber" => $this->diceGame->getPlayerIndex() +1,
            "scoreBoard" => $this->diceGame->printDiceScoreBoard(),
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
