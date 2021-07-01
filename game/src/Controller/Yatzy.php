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
 * @name Yatzy
 * @description Controller class for playing a game of Dice, used by router.
 */
class Yatzy extends ControllerBase
{
    private ?string $scoreBoard = null;

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
        $diceHand = $player->getDiceHand();

        $data = [
            "header" => "Yatzy",
            "message" => "Collect them dices good!",
            "action" => url("/yatzy/process"),
            "round" => $yatzy->getRound(),
            "playerRolls" => $player->getRolls(),
        ];

        if ($diceHand !== null) {
            $data["graphicDices"] = $yatzy->showGraphicDices($diceHand);
        }

        $body = renderView("layout/yatzy.php", $data);

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

        /* Catch POST request from dice__init form and store values to SESSION variable */
        $yatzy = $_SESSION["yatzy"];
        $player = $yatzy->getCurrentPlayer() ?? null;
        $submit = strval($_POST["submit"]) ?? null;
        $diceHand = $player->getDiceHand() ?? null;
        $keepThese = [];

        if ($diceHand !== null) {
            if (isset($_POST["dice--0"])) {
                $keepThese[0] = 0;
            }

            if (isset($_POST["dice--1"])) {
                $keepThese[1] = 1;
            }

            if (isset($_POST["dice--2"])) {
                $keepThese[2] = 2;
            }

            if (isset($_POST["dice--3"])) {
                $keepThese[3] = 3;
            }

            if (isset($_POST["dice--4"])) {
                $keepThese[4] = 4;
            }

            $diceHand->keepDices($keepThese);
        }

        /* Play game */
        $yatzy->play($player, $submit);
        $this->scoreBoard = $yatzy->scoreBoard();

        /* ------------------------------------------------------------ */

        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/yatzy__results/view"));
    }


    /**
     * @name reset
     * @description method to reset game through removing the variable from the session.
     * @return ResponseInterface
     */
    public function reset(): ResponseInterface
    {
        /* - My code -------------------------------------------------- */

        /* Removes the session variable that is diceGame to */
        unset($_SESSION["yatzy"]);

        /* ------------------------------------------------------------ */

        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/yatzy__init/view"));
    }
}