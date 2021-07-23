<?php

declare(strict_types=1);

/**
 * Namespace for this module.
 */
namespace daap19\Controller;

use Mos\Controller\ControllerBase;
use Psr\Http\Message\ResponseInterface;
//use Nyholm\Psr7\Factory\Psr17Factory;
//use daap19\Yatzy;

/**
 * Functions usage.
 */
use function Mos\Functions\{
//    destroySession,
    renderView,
    url
};


/**
 * @name YatzyController
 * @description Controller class for playing a game of Dice, used by router.
 */
class YatzyController extends ControllerBase
{
    private ?string $scoreBoard = null;

    /**
     * @method renderView()
     * @description renders view and returns response object for route controller class.
     * @return ResponseInterface
     */
    final public function renderView(): ResponseInterface
    {
        $yatzy = $_SESSION["yatzy"];
        $player = $yatzy->getCurrentPlayer();
        $diceHand = $player->getDiceHand();

        $data = [
            "header" => "Yatzy",
            "message" => "Collect them dices good!",
            "action" => url("/yatzy/process"),
            "selectScoresURL" => url("/yatzy__selectScores/view"),
            "round" => $yatzy->getRound(),
            "playerRolls" => $player->getRolls(),
        ];

        if ($diceHand !== null) {
            $data["graphicDices"] = $yatzy->showGraphicDices($diceHand);
        }

        $body = renderView("layout/yatzy.php", $data);

        // Return the response through parent class ControllerBase
        return $this->response($body);
    }


    /**
     * @method processResponse()
     * @description method to process POST action to return response object.
     * @return ResponseInterface
     */
    final public function processResponse(): ResponseInterface
    {
        /* Catch POST request from dice__init form and store values to SESSION variable */
        $yatzy = $_SESSION["yatzy"];
        $player = $yatzy->getCurrentPlayer();
        $submit = strval($_POST["submit"]);
        $diceHand = $player->getDiceHand();
        $dices = $diceHand->getDices();
        $keepThese = [];


        /* Keep user selected dice values */
        if ($diceHand !== null) {
            if (isset($_POST["dice-0"])) {
                $keepThese[0] = $dices[0];
            }

            if (isset($_POST["dice-1"])) {
                $keepThese[1] = $dices[1];
            }

            if (isset($_POST["dice-2"])) {
                $keepThese[2] = $dices[2];
            }

            if (isset($_POST["dice-3"])) {
                $keepThese[3] = $dices[3];
            }

            if (isset($_POST["dice-4"])) {
                $keepThese[4] = $dices[4];
            }

            $diceHand->keepDices($keepThese);
        }

        /* Play game */
        $yatzy->play($submit);
        $this->scoreBoard = $yatzy->printYatzyScoreBoard();

        // Return the redirect through parent class ControllerBase destination depends on number of rolls.
        if ($player->getRolls() < 3) {
            return $this->redirect(url("/yatzy/view"));
        }

        return $this->redirect(url("/yatzy__selectScores/view"));
    }
}
