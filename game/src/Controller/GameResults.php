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
 * @name GameResults
 * @description Controller class for initializing a game of Dice, used by router.
 */
class GameResults extends ControllerBase
{
    /**
     * @method renderView()
     * @description renders view and returns response object for route controller class.
     * @return ResponseInterface
     */
    public function renderView(): ResponseInterface
    {
        /* - My code -------------------------------------------------- */

        $diceGame = $_SESSION["diceGame"];
        $players = $diceGame->getPlayers();
        $player = $players[$diceGame->getPlayerIndex()];

        $data = [
            "header" => "DiceGame 21 - Results",
            "message" => "Results for this round.",
            "action" => url("/dice__results/process"),
            "round" => $diceGame->getRound(),
            "playerNumber" => $diceGame->getPLayerIndex() +1,
            "graphicDices" => $diceGame->showGraphicDices($player->getLastHand()),
            "scoreBoard" => $diceGame->scoreBoard(),
        ];

        $body = renderView("layout/dice__results.php", $data);

        /* ------------------------------------------------------------ */


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
        /* - My code -------------------------------------------------- */

        $diceGame = $_SESSION["diceGame"];
        $players = $diceGame->getPlayers();
        $playerIndex = $diceGame->getPlayerIndex();
        $player = $players[$playerIndex];
        $lastIndex = count($players) -1;
        $bust = intval($player->isBust());
        $stopped = intval($player->hasStopped());

        if ($stopped === 1 ?? $bust === 1) {
            if ($playerIndex === $lastIndex) {
                $diceGame->setNextRound();
            }

            $diceGame->setNextPlayerIndex();
        }

        /* ------------------------------------------------------------ */


        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/dice/view"));
    }
}
