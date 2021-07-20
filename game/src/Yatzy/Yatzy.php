<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Yatzy;

use daap19\Dice\ScoreBoardTrait;
use JetBrains\PhpStorm\Pure;

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
    use ScoreBoardTrait;

    private int $round;
    private int $numOfPlayers;
    private array $players;
    private int $playerIndex;


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
    final public function play(string $submit): void
    {
        $player = $this->getCurrentPlayer();
        $playerRolls = $player->getRolls();

        if ($submit === "roll" && $playerRolls < 3) {
            $player->rollDices();
        } elseif ($submit === "stop") {
            $player->stop();
        } elseif ($playerRolls === 3) {
            $player->setForNextRound();
            $this->setPlayerIndex();
            $this->round++;
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
     * @method setNextRound()
     * @description Setter method to increase round number +1.
     * @returns void
     */
    final public function setNextRound(): void
    {
        $this->round++;
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

        if ($diceHand->getSum() > 0) {
            $graphicDices = [];

            foreach ($dices as $key => $diceObject) {
                $graphicDices[$key] = $diceObject->graphicDice();
            }
        }

        return $graphicDices;
    }


    /**
     * @method scoreSelection()
     * @description Method to print out part of form for player to select where to put their scores.
     * @return string
     */
    final public function scoreSelection(): string
    {
        $outputString = "";
        $player = $this->getCurrentPlayer();
        $playerScores = $player->getPlayerScore();
        $yatzyScoreNames = [
            0 => "One's",
            1 => "Two's",
            2 => "Three's",
            3 => "Four's",
            4 => "Five's",
            5 => "Sixes",
            6 => "One pair",
            7 => "Two pairs",
            8 => "Three of a Kind",
            9 => "Four of a Kind",
            10 => "Small strait",
            11 => "Big strait",
            12 => "House",
            13 => "Chance",
            14 => "Yatzy"];

        foreach ($playerScores as $key => $score) {
            if ($score === null) {
                $outputString .= "<label class='yatzyForm__input--label' for='" . $key . "'>";
                $outputString .= "<input class='yatzyForm__input--radio' type='radio' name='scoreSelect' id='" . $key . "' value='" . $key . "' /> ";
                $outputString .= $yatzyScoreNames[$key] . " </label><br> ";
            } elseif (is_int($score)) {
                $outputString .= "<p class='yatzyForm__text--score'> " . $yatzyScoreNames[$key] . " : " . $score . " points </p>";
            }
        }

        return $outputString;
    }
}
