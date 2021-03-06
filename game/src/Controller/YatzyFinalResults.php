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
 * @name YatzyFinalResults
 * @description Controller class for selecting where a player put the scores in a game of Yatzy, used by router.
 */
class YatzyFinalResults extends ControllerBase
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
            "header" => "Yatzy - Players Final Results",
            "message" => "You have compleated this part of the game and here are your current scores.",
            "action" => url("/yatzy__selectScores/process"),
            "round" => $yatzy->getRound(),
            "playerNumber" => $yatzy->getPlayerIndex() +1,
            "scoreBoard" => $yatzy->printYatzyScoreBoard(),
            "playerScores" => $player->getPlayerScore(),
            "scoreSum" => $player->getPlayerScoreSum(),
        ];

        $body = renderView("layout/yatzy__finalResults.php", $data);

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
        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/yatzy/view"));
    }
}
