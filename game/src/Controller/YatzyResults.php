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
 * @name YatzyResults
 * @description Controller class for results in a game of Yatzy, used by router.
 */
class YatzyResults extends ControllerBase
{
    /**
     * @method renderView()
     * @description renders view and returns response object for route controller class.
     * @return ResponseInterface
     */
    public function renderView(): ResponseInterface
    {
        $yatzy = $_SESSION["yatzy"];
        $player = $yatzy->getCurrentPlayer();
        $data = [
            "header" => "Yatzy - Dice Roll Results",
            "message" => "This is the player dice roll results.",
            "action" => url("/yatzy__results/process"),
            "round" => $yatzy->getRound(),
            "playerNumber" => $yatzy->getPlayerIndex() +1,
            "graphicDices" => $yatzy->showGraphicDices($player->getDiceHand()),
            "scoreBoard" => $yatzy->printYatzyScoreBoard(),
        ];

        $body = renderView("layout/yatzy__results.php", $data);

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
        $yatzy = $_SESSION["yatzy"];
        $player = $yatzy->getCurrentPlayer();
        $playerRolls = $player->getRolls();

        // Return the redirect through parent class ControllerBase, the redirect depends on the players amount of dice rolls.
        if ($playerRolls < 3) {
            return $this->redirect(url("/yatzy/view"));
        } elseif ($playerRolls === 3) {
            return $this->redirect(url("/yatzy__selectScores/view"));
        }
    }
}
