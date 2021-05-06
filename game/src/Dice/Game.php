<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;

/**
 * Functions in use.
 */
use function Mos\Functions\{
    destroySession,
//    redirectTo,
    renderView,
    sendResponse,
    url
};

/**
 * Include files:
 * Configuration file.
 */
include(__DIR__ . "/../../config/config.php");

/**
 * Class Dice
 * @package Daap19\Dice
 */
class Game
{
    private array $players = [];
    private ?int $round;
    private ?int $playerIndex;


    /**
     * @method __construct()
     * @description Game class constructor.
     * @param int $numberOfPlayers as the number of players to play the game.
     * @param int $credit as the amount of credit the player start with.
     * @param bool $machine as a indicator a player should be played by the machine.
     */
    public function __construct(int $numberOfPlayers, int $credit, bool $machine)
    {
        $this->round = 0;
        $this->playerIndex = 0;

        /* Setup players */
        for ($i = 0; $i < $numberOfPlayers; $i++) {
            $player = new Player($credit, false);
            $this->players[] = $player;
        }

        /* Setup computer played player */
        if ($machine === true) {
            $machinePlayer = new Player($credit, $machine);
            $this->players[] = $machinePlayer;
        }
    }


    /**
     * @method playGame()
     * @description method to run the game logic.
     * @return void
     */
    final public function playGame(): void
    {
        $data = [
            "header" => "Dice Game 21",
            "message" => "Game on, roll them dices!",
            "action" => url("/dice/process"),
            "view" => "layout/dice.php",
            "output" => $_SESSION["output"] ?? null,
            "round" => $this->round,
            "players" => $this->players,
            "currentPlayer" => $this->getCurrentPlayer(),
            "playerStopped" => $this->players[$this->playerIndex]->hasStopped(),
            "playerNumber" => ($this->playerIndex +1),
        ];

        /* Setup stuff (variables) */
        $dices = $_SESSION["output"] ?? null;
        $player = $this->getCurrentPlayer();
        $computer = $player->isMachineStatus();
        $playerStopped = $player->hasStopped();
        $credit = $player->getCredit();

        $players = $this->getPlayers();
        $data["players"] = $players;

        echo "<p>Players: var_dump($this->getPlayers())</p>";

        /* Run this game */
        if (intval($computer) !== 1 && $credit >= 5) {
            /* Action depending on users input */
            if (($dices !== null && intval($dices) !== 0) && intval($playerStopped) !== 1) {
                /* Roll dices */
                $player->rollDices(intval($dices));

                /* Check player scores */
                $this->checkScore($player);

                /* Graphic diceHand */
                $lastDiceHand = $player->getLastHand();
                $graphicDices = $this->showGraphicDices($lastDiceHand);
                $data["graphicDices"] = $graphicDices;

            } elseif (($dices !== null && intval($dices) === 0)  && intval($playerStopped) !== 1) {
                /* Player stop here */
                $player->stop();

                /* Check player scores */
                $this->checkScore($player);

                /* Load to variables for Graphic diceHand presentation */
                $lastDiceHand = $player->getLastHand();
                $graphicDices = $this->showGraphicDices($lastDiceHand);
                $data["graphicDices"] = $graphicDices;

                /* Proceed with next player */
                $this->setNextPlayerIndex();
            }
        } elseif (intval($computer) === 1 && $credit >= 5) {
            $this->playComputer($player);

            /* Load to variables for Graphic diceHand presentation */
            $lastDiceHand = $player->getLastHand();
            $graphicDices = $this->showGraphicDices($lastDiceHand);
            $data["graphicDices"] = $graphicDices;

            /* Proceed with next player */
            $this->setNextPlayerIndex();
        }

        /* Generate ScoreBoard */
        $scoreBoard = $this->scoreBoard();
        $data["scoreBoard"] = $scoreBoard;

        /* Render data */
        $this->outputData($data);
    }


    /**
     * @method playComputer()
     * @description simulated computer run for dice game 21. Its supposed to try an end up within the limits of a good run but hey its not perfect, it just plays.
     * @param object $player as the player to run as a computer.
     * @return void
     */
    final public function playComputer(object $player): void
    {
        $stopped = $player->hasStopped();
        $score = $player->getScore();
        $iterator = 0;

        /* Computer run until conditions are met */
        while (intval($stopped) !== 1) {

            /* Run depending on players score */
            if (intval($stopped) !== 1 && $score < (12)) {
                /* Play two dices */
                $player->rollDices(2);
                $this->checkScore($player);

            } elseif (intval($stopped) !== 1 && $score >= 12 && $score < 18) {
                /* Play one dice */
                $player->rollDices(1);
                $this->checkScore($player);

            } elseif (intval($stopped) !== 1 && $score >= 18 && $score <= 21) {
                $player->stop();
                $this->checkScore($player);
                break;
            } elseif (intval($stopped) !== 1 && $score > 21) {
                $this->checkScore($player);
                break;
            }

            /* Testing safety breaker */
            if ($iterator === 22) {
                echo "<p>BREAK THE WHILE LOOP IN COMPUTER PLAYER!!!</p>";
                break;
            }

            /* Check these values every iteration of the loop */
            $stopped = $player->hasStopped();
            $score = $player->getScore();
            $iterator++;
        }
    }


    /**
     * @method showGraphicDices()
     * @description method to help show graphic representations of dices in dice hand.
     * @param object $diceHand as representation of a hand of dice objects.
     * @return array of strings representing classes to show a dice.
     */
    final public function showGraphicDices(object $diceHand): array
    {
        $graphicDices = [];
        $dices = $diceHand->getDices();
        $numOfDices = count($dices);

        for ($i = 0; $i < $numOfDices; $i++) {
            $diceResult = $dices[$i]->graphicDice();
            $graphicDices[$i] = $diceResult;
        }

        return $graphicDices;
    }


    /**
     * @method getCurrentPlayer()
     * @description getter method for current player to make a move in the game.
     * @return object as player in the game.
     */
    final public function getCurrentPlayer(): object
    {
        return $this->players[$this->playerIndex];
    }


    /**
     * @method setNextPlayerIndex()
     * @description setter method for integer to represent index for current player in array of all players.
     * @return void
     */
    final public function setNextPlayerIndex(): void
    {
        echo "<p>SET NEXT PLAYER INDEX!!!</p>";
        $lastIndex = (count($this->players) -1);

        /* Sort out status */
        if ($this->playerIndex < $lastIndex) {
            $this->playerIndex++;

        } elseif ($this->playerIndex === $lastIndex) {

            /* Setup for next round */
            $this->setNextRound();

            /* Reset playerIndex & set next round */
            $this->solveTheBet();
            $this->playerIndex = 0;
        }
    }


    /**
     * @method checkScore()
     * @description method to check the score for the player. Sets player att stop if player is above 21.
     * @param object $player as the player to check score on.
     * @return void
     */
    final public function checkScore(object $player): void
    {
        echo "<p>CHECK SCORE FOR PLAYER!!!</p>";
        $stopped = $player->hasStopped();
        $score = $player->getScore();

        if ($score > 21 && intval($stopped) !== 1) {
            echo "<p>CHECK SCORE - MUST STOP!</p>";
            $player->stop();
            $this->setNextPlayerIndex();
        }
    }


    /**
     * @method scoreBoard()
     * @description method is used to generate a scoreboard for all players.
     * @return string
     */
    final public function scoreBoard(): string
    {
        /* Setup score board outer container element */
        $numOfPlayers = count($this->players);
        $outputElement = "<div class=\"diceForm__results--container\">";

        /* Generate inner elements for scores */
        for ($i = 0; $i < $numOfPlayers; $i++) {
            /* Results as string */
            $stringRes = $this->players[$i]->getResultsAsString();
            $average = $this->players[$i]->getAverage();
            $totalScore = $this->players[$i]->getScore();
            $playerCredit = $this->players[$i]->getCredit();

            /* Build elements */
            $outputElement .= "<div class=\"diceForm__results--player-" . $i . "\">";
            $outputElement .= "<h4>Player " . ($i +1) . "</h4>";

            /* Only add elements if player have results */
            if ($totalScore > 0) {
                $outputElement .= "<p>$stringRes</p>";
                $outputElement .= "<p>Average dice value = " . $average . "</p>";
                $outputElement .= "<p>Player " . ($i+1) . " score = " . $totalScore . "</p>";
            }

            $outputElement .= "<p>Credit: " . $playerCredit . "</p>";
            $outputElement .= "</div>";
        }

        /* Close outer element container tag */
        $outputElement .= "</div>";

        return $outputElement;
    }


    /**
     * @method solveTheBet()
     * @description method is dealing with the credit swaps between players depending on results.
     * @return void
     */
    final public function solveTheBet(): void
    {
        $winner = null;
        $theBet = 0;
        $roundResults = [];
        $numOfPlayers = count($this->players);

        /* Build associative array (key/value) from players results */
        for ($i = 0; $i < $numOfPlayers; $i++) {
            $player = $this->players[$i];
            $score = $player->getScore();
            $roundResults[$i] = $score;
        }

        /* Sort the array descending order */
        uasort($roundResults, function ($sampleA, $sampleB) {
            if ($sampleA == $sampleB) {
                return 0;
            }
            return ($sampleA > $sampleB) ? -1 : 1;
        });

        /* Iterate on the sorted array to get first match = winner, then break loop */
        foreach ($roundResults as $key => $value) {
            /* First value to match */
            if ($value <= 21) {
                $winner = $this->players[$key];

                break; // break the loop on first match.
            }
        }

        /* Collect the bet from loosing players */
        for ($i = 0; $i < $numOfPlayers; $i++) {
            if ($this->players[$i] !== $winner) {
                $oldCredit = $this->players[$i]->getCredit();
                $theBet += 5;
                $newCredit = ($oldCredit -5);
                $this->players[$i]->setCredit($newCredit);
            }
        }

        /* Give the winner some bitcoins */
        $oldCredit = $winner->getCredit();
        $newCredit = $oldCredit + $theBet;
        $winner->setCredit($newCredit);
    }


    /**
     * @method showResults()
     * @description method to present results after round of dice game.
     * @return void
     */
    final public function showResults(): void
    {
        $data = [
            "header" => "Round " . ($this->round +1) . " results",
            "message" => "Here are the results from the last round of Dice 21.",
            "action" => url("/dice__results/process"),
            "view" => "layout/dice__results.php",
            "output" => null
        ];
    }


    /**
     * @method setNextRound()
     * @description increase the integer indicating what round in the game is played.
     * @return void
     */
    final public function setNextRound(): void
    {
        echo "<p>NEXT ROUND! </p><br>";
        $this->playerIndex = 0;
        $numOfPlayers = count($this->players);

        /* Reset status for all players */
        for ($i = 0; $i < $numOfPlayers; $i++) {
            $thisPlayer = $this->players[$i];
            $thisPlayer->setForNextRound();
        }

        $this->round++;
    }

    /**
     * @method getPlayers()
     * @description getter method to return array of player objects representing all the players in the game.
     * @return array of player objects.
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @method outputData()
     * @description method is used to prepare $data variable for rendering of views & sending response.
     * @param array $data as variables to process in view.
     * @return void
     */
    final public function outputData(array $data): void
    {
        /* Let the view work with the DATA array, keep the view stupid! */
        $body = renderView($data["view"], $data);
        sendResponse($body);
    }

    /**
     * @method reset()
     * @description method to reset game through destroy the session.
     * @return void
     */
    final public function reset(): void
    {
        destroySession();
    }
}
