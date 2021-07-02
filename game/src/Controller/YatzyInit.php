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
        /* - My code -------------------------------------------------- */

        /* Instead of overriding the old session for yatzy, redirect to the existing one. */
        if (isset($_SESSION["yatzy"])) {
            return $this->redirect(url("/yatzy/view"));
        }

        $data = [
            "header" => "Welcome to Yatzy",
            "message" => "Welcome to a game of Yatzy. 
                This is a simplyfied version of the game yatzy. Please press start.",
            "action" => url("/yatzy__init/process"),
        ];

        $body = renderView("layout/yatzy__init.php", $data);

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

        /* Create new DiceGame object on SESSION variable */
        $_SESSION["yatzy"] = new Yatzy();

        /* ------------------------------------------------------------ */

        // Return the redirect through parent class ControllerBase
        return $this->redirect(url("/yatzy/view"));
    }
}
