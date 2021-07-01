<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Yatzy;

/**
 * Functions in use.
 */
//use function Mos\Functions\ {
//    destroySession,
//    redirectTo,
//    renderView,
//    sendResponse,
//    url
//};

/**
 * Include files:
 * Configuration file.
 */
include(__DIR__ . "/../../config/config.php");

/**
 * Class Yatzy
 * @package Daap19\Dice
 */
class Yatzy
{
    private ?int $round;
    private ?int $numOfPlayers = null;
    private ?array $players;
    private ?int $playerIndex;


    /**
     * @method __construct()
     * @description Yatzy class constructor method.
     *              Takes integer argument to create number of players from.
     *              Through for-loop creates each player as new object from YatzyPlayer class.
     *              Adds the newly created player to array of players for this yatzy session.
     * @param int $numOfPlayers as number of new players to create, default value is 1.
     */
    public function __construct(int $numOfPlayers = 1)
    {
        /**
         * Set round number.
         * Set playerIndex to get the current player.
         * Create all players thru for-loop.
         * Count the players and store value to property.
         */
        $this->round = 0;
        $this->playerIndex = 0;

        for ($i = 0; $i < $numOfPlayers; $i++) {
            $newPlayer = new YatzyPlayer();
            $this->players[$i] = $newPlayer;
        }

        $this->numOfPlayers = count($this->players);
    }


    /**
     * @method play()
     * @description Method to play game with.
     * @returns void
     */
    final public function play(object $player, string $submit)
    {
        $player = $this->players[$this->playerIndex];
        $playerRolls = $player->getRolls();

        if ($submit === "roll" && $playerRolls < 3) {
            $player->rollDices();
        } elseif ($submit === "stop") {
            $player->stop();
        } elseif ($playerRolls === 3) {
            $this->round++;
            $player->setReadyForNextRound();
            $this->setPlayerIndex();
        }
    }


    /**
     * @method getRound()
     * @description returns integer value representing the current round of the game.
     * @return int as round of the game.
     */
    final public function getRound(): int
    {
        return $this->round;
    }


    /**
     * @method getPlayers()
     * @description getter method to return array of player objects representing all the players in the game.
     * @return array of player objects.
     */
    final public function getPlayers(): array
    {
        return $this->players;
    }


    /**
     * @method getCurrentPlayer()
     * @description getter method for the current player.
     * @return object as player in the game.
     */
    final public function getCurrentPlayer(): object
    {
        $index = $this->getPlayerIndex();

        return $this->players[$index];
    }


    /**
     * @method getPlayerIndex()
     * @description getter method for the player index that indicates who's turn it is.
     * @return int as playerIndex.
     */
    final public function getPlayerIndex(): int
    {
        return $this->playerIndex;
    }


    /**
     * @method setPlayerIndex()
     * @description setter method for integer to represent index of current player in array of all players.
     * @return void
     */
    final public function setPlayerIndex(): void
    {
        $lastIndex = (count($this->players) -1);

        /* Sort out status */
        if ($this->playerIndex < $lastIndex) {
            $this->playerIndex++;
        } else if ($this->playerIndex === $lastIndex) {
            $this->playerIndex = 0;
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
     * @method scoreBoard()
     * @description method is used to generate a scoreboard for all players.
     * @return string
     */
    final public function scoreBoard(): string
    {
        /* Setup score board outer container element */
        $this->scoreBoard = "<div class=\"diceForm__results--container\">";

        foreach ($this->players as $key => $player) {
            /* Results as string */
            $stringRes = $player->getLastRollAsString();
            $average = $player->getAverage();
            $totalScore = $player->getScore();
//            $stopped = $player->hasStopped();

            /* Build elements */
            $this->scoreBoard .= "<div class=\"diceForm__results--player-" . $key . "\">";
            $this->scoreBoard .= "<h4>YatzyPlayer " . ($key +1) . "</h4>";

            /* Only add elements if player have results */
            if ($totalScore > 0) {
                $this->scoreBoard .= "<p>$stringRes</p>";
                $this->scoreBoard .= "<p>Average dice value = " . $average . "</p>";
                $this->scoreBoard .= "<p>Player " . ($key+1) . " score = " . $totalScore . "</p>";
            }

//            /* Print message if player stopped or is bust. */
//            if (intval($stopped) === 1) {
//                $this->scoreBoard .= "<span>YatzyPlayer has stopped.</span>";
//            }

            /* Close the players div */
            $this->scoreBoard .= "</div>";
        }

        /* Close outer element container tag */
        $this->scoreBoard .= "</div>";

        return $this->scoreBoard;
    }
}
