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
        /* - My code -------------------------------------------------- */

        $yatzy = $_SESSION["yatzy"];
        $player = $yatzy->getCurrentPlayer();

        $data = [
            "header" => "Dice DiceGame 21",
            "message" => "Results for this round.",
            "action" => url("/yatzy__results/process"),
            "round" => $yatzy->getRound(),
            "playerNumber" => $yatzy->getPlayerIndex() +1,
            "graphicDices" => $yatzy->showGraphicDices($player->getDiceHand()),
            "scoreBoard" => $yatzy->scoreBoard(),
        ];

        $body = renderView("layout/yatzy__results.php", $data);

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

//        $yatzy = $_SESSION["yatzy"];
//        $players = $yatzy->getPlayers();
//        $playerIndex = $yatzy->getPlayerIndex();
//        $player = $players[$playerIndex];
//        $lastIndex = count($players) -1;
//        $bust = intval($player->isBust());
//        $stopped = intval($player->hasStopped());
//
//        if ($stopped === 1) {
//            if ($playerIndex === $lastIndex) {
//                $yatzy->setNextRound();
//            }
//
//            $yatzy->setNextPlayerIndex();
//        }



        /* ------------------------------------------------------------ */


        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/yatzy/view"));
    }
}
