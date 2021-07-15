<?php

declare(strict_types=1);

/**
 * Namespace for this module & other namespaces in use.
 */
namespace daap19\Controller;
use Mos\Controller\ControllerBase;
use Psr\Http\Message\ResponseInterface;
use daap19\Yatzy\Yatzy;


/**
 * Functions usage.
 */
use function Mos\Functions\{
//    destroySession,
    renderView,
    url
};


/**
 * @name YatzyInit
 * @description Controller class for route to initializing a game of Yatzy, used by router.
 */
class YatzyInit extends ControllerBase
{
    /**
     * @method renderView()
     * @description renders view and returns response object for route controller class.
     * @return ResponseInterface as response object
     */
    public function renderView(): ResponseInterface
    {
        /* Instead of overriding the old session for yatzy, redirect to the existing one. */
        if (isset($_SESSION["yatzy"])) {
            return $this->redirect(url("/yatzy/view"));
        }

        $data = [
            "header" => "Play a game of Yatzy",
            "message" => "Welcome to a game of Yatzy. 
                This is a simplyfied version of the game Yatzy. 
                You will only play the first part of the game where you roll and collect dices of the same value. 
                First you roll the dices then you select the dices to keep/hold, if any, before you roll again. 
                You have three times rolling the dices per round. At the end of each round you can choose where to position your points/dices, 
                check your hand carefully before selecting position as it will be zero points if no dices of the selected value exists.
                After all posibilities f placing your points/dices have been chosen the game is over and you will see a summary of your game.
                Please press start to play, good luck!",
            "action" => url("/yatzy__init/process"),
        ];

        $body = renderView("layout/yatzy__init.php", $data);

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
        /* Create new DiceGame object on SESSION variable */
        $_SESSION["yatzy"] = new Yatzy();

        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/yatzy/view"));
    }
}
