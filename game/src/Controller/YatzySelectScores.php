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
 * @name YatzySelectScores
 * @description Controller class for selecting where a player put the scores in a game of Yatzy, used by router.
 */
class YatzySelectScores extends ControllerBase
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
            "header" => "Yatzy - Player Points Selection",
            "message" => "Select where on the chart to place your points. Once your points for this round have been placed you can not place more points to this position. Try to make strategic placement for a higher sum total as your end result.",
            "action" => url("/yatzy__selectScores/process"),
            "round" => $yatzy->getRound(),
            "playerNumber" => $yatzy->getPlayerIndex() +1,
            "graphicDices" => $yatzy->showGraphicDices($player->getDiceHand()),
            "scoreBoard" => $yatzy->printYatzyScoreBoard(),
            "scoreSelection" => $yatzy->scoreSelection(),
            "scoreSum" => $player->getPlayerScoreSum(),
        ];

        $body = renderView("layout/yatzy__selectScores.php", $data);

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
        $diceHand = $player->getDiceHand();
        $lastRoll = $player->getLastRoll();
        $maxScores = count($player->getPlayerScore());
        $playerSavedScores = $player->getAmountOfScoresSaved();

        /* Control where points are stored */
        switch ($_POST["scoreSelect"]) {
            case "0":
                $player->saveScores($lastRoll, 1);
                break;
            case "1":
                $player->saveScores($lastRoll, 2);
                break;
            case "2":
                $player->saveScores($lastRoll, 3);
                break;
            case "3":
                $player->saveScores($lastRoll, 4);
                break;
            case "4":
                $player->saveScores($lastRoll, 5);
                break;
            case "5":
                $player->saveScores($lastRoll, 6);
                break;
        }

        $playerSavedScores++;
        $diceHand->setForNextRound();
        $player->setForNextRound();
        $yatzy->setNextRound();

        if ($playerSavedScores < $maxScores) {
            // Return the redirect through parent class ControllerBase
            return $this->redirect(url("/yatzy/view"));
        }

        // Return the redirect through parent class ControllerBase if player saved $maxScores or more.
        return $this->redirect(url("/yatzy__finalResults/view"));

    }
}
