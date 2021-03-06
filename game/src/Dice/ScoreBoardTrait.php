<?php


/**
 * Namespace declaration & other namespaces in use.
 */
namespace daap19\Dice;


/**
 * Trait ScoreBoardTrait
 * @package daap19\Dice
 */
trait ScoreBoardTrait
{
    /**
     * @method printDiceScoreBoard()
     * @description trait method is used to generate a scoreboard for all players in a game of Dice 21.
     * Counts players. Sets up a element container for the scoreboard.
     * Gets the player then collects data from the player object thru its class methods.
     * Builds information elements depending on the data collected.
     * Closes the containing element.
     * Returns a string object to be presented as a score board.
     * @return string
     */
    final public function printDiceScoreBoard(): string
    {
        /* Setup score board outer container element */
        $this->numOfPlayers = count($this->players);
        $scoreBoard = "<div class=\"diceForm__results--container\">";

        /* Generate inner elements for scores */
        for ($i = 0; $i < $this->numOfPlayers; $i++) {

            /* Get the player */
            $player = $this->players[$i];

            /* Collect data from player object thru its methods */
            $stringRes = $player->getResultsAsString();
            $average = $player->getAverage();
            $totalScore = $player->getSumTotal();
            $playerCredit = $player->getCredit();
            $playerWins = $player->getWins();
            $stopped = $player->hasStopped();
            $bust = $player->isBust();

            /* Build elements */
            $scoreBoard .= "<div class=\"diceForm__results--player-" . $i . "\">";
            $scoreBoard .= "<h4>Player " . ($i +1) . "</h4>";

            /* Only add elements if player have results */
            if ($totalScore > 0) {
                $scoreBoard .= "<p>$stringRes</p>";
                $scoreBoard .= "<p>Average dice value = " . $average . "</p>";
                $scoreBoard .= "<p>Player " . ($i+1) . " score = " . $totalScore . "</p>";
            }

            /* Remaining credit for this player */
            $scoreBoard .= "<p>Credit: " . $playerCredit . "</p>";

            /* If there are winning round print them */
            if ($playerWins > 0) {
                $scoreBoard .= "<p>Winning rounds: " . $playerWins . "</p>";
            }

            /* Print message if player stopped or is bust. */
            if (intval($bust) === 1) {
                $scoreBoard .= "<span>YatzyPlayer is bust.</span>";
            } else if (intval($stopped) === 1) {
                $scoreBoard .= "<span>YatzyPlayer has stopped.</span>";
            }

            /* Close the div */
            $scoreBoard .= "</div>";
        }

        /* Close outer element container tag */
        $scoreBoard .= "</div>";

        return $scoreBoard;
    }


    /**
     * @method printYatzyScoreBoard()
     * @description trait method is used to generate a scoreboard for all players in a game of Yatzy.
     * Counts players. Sets up a element container for the scoreboard.
     * Gets the player then collects data from the player object thru its class methods.
     * Builds information elements depending on the data collected.
     * Closes the containing element.
     * Returns a string object to be presented as a score board.
     * @return string
     */
    final public function printYatzyScoreBoard(): string
    {
        /* Setup score board outer container element */
        $scoreBoard = "<div class=\"diceForm__results--container\">";

        foreach ($this->players as $key => $player) {

            /* Results as string */
            $playerNumber = $this->getPlayerIndex() +1;
            $sum = $player->getScore();
            $average = $player->getAverage();
            $totalScore = $player->getPlayerScoreSum();
            $diceHand = $player->getDiceHand();
            $graphicDices = $this->showGraphicDices($diceHand);

            /* Build elements */
            $scoreBoard .= "<div class=\"diceForm__results--player-" . $key . "\">";
            $scoreBoard .= "<h4>Player " . ($key +1) . "</h4>";

            /* Add graphic dices to scoreboard */
            foreach ($graphicDices as $key => $diceClass) {
                $scoreBoard .= "<span class=\"dice-utf8\">";
                $scoreBoard .= "<i class=" . $diceClass . "></i>";
                $scoreBoard .= "</span>";
            }


            $scoreBoard .= "<p>Dice hand sum total: <b>" . $sum . "</b></p>";
            $scoreBoard .= "<p>Player rolls an average dice value of: <b>" . $average . "</b></b></p>";

            /* Only add element if player have results */
            if ($totalScore > 0) {
                $scoreBoard .= "<p>Player " . $playerNumber . " game score: <b>" . $totalScore . "</b></p>";
            }

            /* Close the player container div element */
            $scoreBoard .= "</div>";
        }

        /* Close outer container element tag */
        $scoreBoard .= "</div>";

        return $scoreBoard;
    }
}
