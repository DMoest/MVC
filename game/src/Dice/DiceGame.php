<?php

/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;

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
 * Class Dice
 * @package Daap19\Dice
 */
class DiceGame
{
    use ScoreBoardTrait;

    private array $players = [];
    private ?int $round;
    private ?int $playerIndex;
    private ?int $numOfPlayers;


    /**
     * @method __construct()
     * @description DiceGame constructor class.
     * @param int $numOfPlayers as the number of players to play the game.
     * @param int $credit as the amount of credit the player start with.
     * @param bool $machine as a indicator a player should be played by the machine.
     */
    public function __construct(int $numOfPlayers, int $credit, bool $machine)
    {
        $this->round = 1;
        $this->playerIndex = 0;

        /**
         * Setup user players
         * @description Setup user players with for loop to generate players on construct. Input is taken from user thru request form.
         */
        for ($i = 0; $i < $numOfPlayers; $i++) {
            $newPlayer = new DicePlayer($credit, false);
            $this->players[] = $newPlayer;
        }

        /**
         * Setup computer player
         * @description Setup computer controlled player if variable validates to boolean true.
         */
        if (intval($machine) === 1) {
            $machinePlayer = new DicePlayer($credit, $machine);
            $this->players[] = $machinePlayer;
        }

        $this->numOfPlayers = count($this->players);
    }


    /**
     * @method playGame()
     * @description method to run the game logic.
     * @param int $dices
     * @param string $submit
     * @return void
     */
    final public function playGame(int $dices, string $submit): void
    {
        /**
         * Check values through calling methods on the player class.
         * First get the player, second check if player is computer or not, third check if player has stopped and last check if player is bust.
         */
        $player = $this->players[$this->playerIndex];
        $computer = intval($player->isMachine());
        $stopped = intval($player->hasStopped());
        $bust = intval($player->isBust());

        /**
         * If player is not computer, not stopped and not bust. Run this game through method player round.
         * Else play round through computer.
         */
        if ($computer !== 1 && $stopped !== 1 && $bust !== 1) {
            $this->playerRound($player, $submit, $dices);
        } else if ($computer === 1 && $stopped !== 1 && $bust !== 1) {
            $this->playComputer($player);
        }
    }


    /**
     * @method playerRound()
     * @description method to execute a players round.
     * @param object $player
     * @param string $submit
     * @param int $dices
     * @returns void
     */
    final public function playerRound(object $player, string $submit, int $dices): void
    {
        /**
         * Depending on submit choice from user.
         * If submit is roll:
         * YatzyPlayer rolls dices then check the players score.
         * Else if stop:
         * YatzyPlayer stop to await other players move.
         */
        if ($submit === "roll") {
            $player->rollDices($dices);
            $this->checkScore($player);
        } else if ($submit === "stop") {
            $player->stop();
        }
    }


    /**
     * @method playComputer()
     * @description simulated computer run for dice game 21. Its supposed to try an end up within the limits of a good run but hey its not perfect, it just plays.
     * @param object $player as the player to run as a computer.
     * @return void
     */
    final public function playComputer(object $player): void
    {
        $stopped = intval($player->hasStopped());
        $bust = intval($player->isBust());
        $score = $player->getScore();

        /**
         * Computer run until conditions are met.
         */
        while ($stopped === 0 && $bust === 0) {
            /**
             * Run depending on players score.
             * First roll 2 dices if score is less then 12.
             * Second if score is more then 12 roll 1 dice.
             * Third if score is between 18 and 21, stop to stay in this game round.
             */
            if ($score < (12)) {
                $player->rollDices(2);
            } else if ($score >= 12 && $score < 18) {
                $player->rollDices(1);
            } else if ($score >= 18 && $score <= 21) {
                $player->stop();
            }

            /**
             * Check these values every iteration of the while-loop:
             * Check score, check if player has stopped, check if player is bust and last get the new player score.
             */
            $this->checkScore($player);
            $bust = intval($player->isBust());
            $score = $player->getScore();
            $stopped = intval($player->hasStopped());
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

        foreach ($dices as $key => $diceObject) {
            $graphicDices[$key] = $diceObject->graphicDice();
        }

        return $graphicDices;
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
     * @method getPlayerIndex()
     * @description getter method for the player index that indicates who's turn it is.
     * @return int as playerIndex.
     */
    final public function getPlayerIndex(): int
    {
        return $this->playerIndex;
    }


    /**
     * @method setNextPlayerIndex()
     * @description setter method for integer to represent index for current player in array of all players.
     * @return void
     */
    final public function setNextPlayerIndex(): void
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
     * @description Solve the bet for this round. Setup players to start new round. Iterate round forward.
     * @return void
     */
    final public function setNextRound(): void
    {
        $numOfPlayers = count($this->players);
        $this->solveTheBet();

        /**
         * Reset status for all players.
         */
        for ($i = 0; $i < $numOfPlayers; $i++) {
            $thisPlayer = $this->players[$i];
            $thisPlayer->setForNextRound();
        }

        $this->round++;
    }


    /**
     * @method checkScore()
     * @description method to check the score for the player. Sets player att stop if player is above 21.
     * @param object $player as the player to check score on.
     * @return void
     */
    final public function checkScore(object $player): void
    {
        $stopped = intval($player->hasStopped());
        $score = $player->getScore();

        if ($score > 21 && $stopped !== 1) {
            $player->setBust();
            $player->stop();
        }
    }


    /**
     * @method solveTheBet()
     * @description method is dealing with the credit swaps between players depending on results.
     * @return void
     */
    final public function solveTheBet(): void
    {
        $theBet = 0;
        $numOfPlayers = count($this->players);
        $potentialWinners = [];
        $potentialWinnerVal = [];
        $winners = [];

        /**
         * Collect the bet from all players.
         */
        for ($i = 0; $i < $numOfPlayers; $i++) {
            $player = $this->players[$i];

            if (intval($player->isOut()) !== 1) {
                $oldCredit = $this->players[$i]->getCredit();
                $theBet += 5;
                $newCredit = ($oldCredit -5);
                $this->players[$i]->setCredit($newCredit);
            }
        }

        /**
         * Build associative array $roundResults from players result.
         * Build associative array $potentialWinners from players that is not bust.
         */
        for ($i = 0; $i < $numOfPlayers; $i++) {
            /* get player data */
            $player = $this->players[$i];
            $score = $player->getScore();

            /* Only proceed if player is NOT bust in the game round */
            if (intval($player->isBust()) !== 1 && intval($player->isOut()) !== 1) {
                /* Get the possible winners to associative array */
                $potentialWinners[$i] = $player;
                $potentialWinnerVal[$i] = $score;
            }
        }

        /**
         * Sort out the winners from array $potentialWinners with max() function.
         */
        foreach ($potentialWinners as $player) {
            $score = $player->getScore();

            /* Include all players who have the winning score */
            if ($score === max($potentialWinnerVal)) {
                $winners[] = $player;
            }
        }

        /**
         * Give winners some credit.
         */
        foreach ($winners as $player) {
            $creditWin = ($theBet / count($winners));
            $oldCredit = $player->getCredit();
            $newCredit = ($oldCredit + $creditWin);
            $player->setCredit($newCredit);
            $player->setWin();
        }
    }
}
