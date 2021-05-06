<?php
/**
 * Strict types declaration.
 */
declare(strict_types=1);


/**
 * Namespaces in use.
 */
namespace Mos\Router;

use daap19\Dice\Game;


/**
 * Functions in use.
 */
use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};


/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/form/view") {
            $data = [
                "header" => "Form",
                "message" => "Press submit to send the message to the result page.",
                "action" => url("/form/process"),
                "output" => $_SESSION["output"] ?? null,
            ];
            $body = renderView("layout/form.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/form/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            redirectTo(url("/form/view"));
            return;
        } else if ($method === "GET" && $path === "/dice__init/view") {
            $data = [
                "header" => "Startup a game of Dice 21",
                "message" => "Please choose how to play.",
                "action" => url("/dice__init/process"),
                "output" => $_SESSION["output"] ?? null,
                "players" => $_POST["numberOfPlayers"] ?? null,
                "credit" => $_POST["credit"] ?? null,
            ];

            $body = renderView("layout/dice__init.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/dice__init/process") {

            /* Setup new game */
            $diceGame = new Game(intval($_POST["numberOfPlayers"]), intval($_POST["credit"]), true);
            $_SESSION["diceGame"] = $diceGame ?? null;

            redirectTo(url("/dice/view"));
            return;
        } else if ($method === "GET" && $path === "/dice/view") {

            /* set session to variable for easy access & execution */
            $callable = $_SESSION["diceGame"];

            /* Execute method on the object of the named session to start the game */
            $callable->playGame();

            return;
        } else if ($method === "POST" && $path === "/dice/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            redirectTo(url("/dice/view"));
            return;
        }  else if ($method === "GET" && $path === "/dice__results/view") {
            $data = [
                "header" => "Startup a game of Dice 21",
                "message" => "Please choose how to play.",
                "action" => url("/dice__results/process"),
                "view" => "layout/dice.php",
                "output" => $_SESSION["output"] ?? null,
                "players" => $_POST["numberOfPlayers"] ?? null,
                "credit" => $_POST["credit"] ?? null,
            ];

            $body = renderView("layout/dice__results.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/dice__results/process") {

            echo "<p>ENTER ROUTE DICE__RESULTS</p>";

            /* Setup for next round */
//            $_SESSION["diceGame"]->setNextRound();

            redirectTo(url("/dice__results/view"));
            return;
        }

        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];

        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
