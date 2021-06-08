<?php

declare(strict_types=1);

/**
 * Namespace for this module & other namespaces in use.
 */
namespace daap19\Controller;
use Mos\Controller\ControllerBase;
use Psr\Http\Message\ResponseInterface;
use daap19\Dice\Game;

/**
 * Functions usage.
 */
use function Mos\Functions\{
//    destroySession,
    renderView,
    url
};


/**
 * @name DiceInit
 * @description Controller class for route to initializing a game of Dice, used by router.
 */
class DiceInit extends ControllerBase
{
    /**
     * @method renderView()
     * @description renders view and returns response object for route controller class.
     * @return ResponseInterface as response object
     */
    public function renderView(): ResponseInterface
    {
        /* - My code -------------------------------------------------- */

        $data = [
            "header" => "Dice Game 21",
            "message" => "Welcome, please setup a game of dice. 
                You choose the amout of players to be in it and the starting credit each player have. 
                Keep in mind that there will be an extra player added on top of the number you choose. 
                This player is played by the computer.",
            "action" => url("/dice__init/process"),
        ];

        $body = renderView("layout/dice__init.php", $data);

        /* ------------------------------------------------------------ */


        // Return the response through parent class ControllerBase
        return $this->response($body);
    }


    /**
     * @method processResponse()
     * @description method to process response object from POST action.
     * @return ResponseInterface as response object
     */
    public function processResponse(): ResponseInterface
    {
        /* - My code -------------------------------------------------- */

        /* Catch POST request from dice__init form */
        $players = intval($_POST["players"]) ?? null;
        $startCredit = intval($_POST["credit"]) ?? null;
        $machine = null;

        if (isset($_POST["machine"])) {
            $machine = boolval($_POST["machine"]) ?? null;
        } elseif(!isset($_POST["machine"])) {
            $machine = false;
        }

        /* Create new Game object on SESSION variable */
        $diceGame = new Game($players, $startCredit, $machine);
        $_SESSION["diceGame"] = $diceGame;

        /* ------------------------------------------------------------ */


        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/dice/view"));
    }
}
