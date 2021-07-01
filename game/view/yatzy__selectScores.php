<?php
/**
 * Strict types declaration.
 */
declare(strict_types=1);

/**
 * Declare variables in use.
 */
$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$selectScoresURL = $selectScoresURL ?? null;
$dices = $dices ?? null;
$submit = $submit ?? null;
$round = $round ?? null;
$players = $players ?? null;
$playerNumber = $playerNumber ?? null;
$playerRolls = $playerRolls ?? null;
$diceHand = $diceHand ?? null;
$diceHandLastRoll = $diceHandLastRoll ?? null;
$graphicDices = $graphicDices ?? null;
$scoreBoard = $scoreBoard ?? null;
$score = $score ?? null;
$credit = $credit ?? null;

?>

<h1><?= $header ?></h1>
<p><i><?= $message ?></i></p>

<form method="post" action="<?= $action ?>" class="diceForm">
    <p>Player rolled the dices: <?= $playerRolls ?> times.</p>

    <?php if ($graphicDices !== null) : ?>
        <p class="diceForm__results">

        <!-- Present the player -->
        <h3>Player <?= $playerNumber ?> score</h3>

        <form class="">
            <p><i>Select where on the chart to place your points.</i></p>

            <label for="one">
                <input type="radio" name="scorePosition" id="input" value="one" /> One</label><br>
            <label for="two">
                <input type="radio" name="scorePosition" id="two" value="two" /> Two</label><br>
            <label for="three">
                <input type="radio" name="scorePosition" id="three" value="three" /> Three</label><br>
            <label for="four">
                <input type="radio" name="scorePosition" id="four" value="four" /> Four</label><br>
            <label for="five">
                <input type="radio" name="scorePosition" id="five" value="five" /> Five</label><br>
            <label for="six">
                <input type="radio" name="scorePosition" id="six" value="six" /> Six</label><br>

            <hr>

            <label for="onePair">
                <input type="radio" name="scorePosition" id="onePair" value="onePair" /> One pair</label><br>
            <label for="three">
                <input type="radio" name="scorePosition" id="three" value="twoPairs" /> Two pairs</label><br>
            <label for="threeOfAKind">
                <input type="radio" name="scorePosition" id="threeOfAKind" value="threeOfAKind" /> Three of a Kind</label><br>
            <label for="fourOfAKind">
                <input type="radio" name="scorePosition" id="fourOfAKind" value="fourOfAKind" /> Four of a Kind</label><br>
            <label for="smallStraight">
                <input type="radio" name="scorePosition" id="smallStraight" value="smallStraight" /> Small straight</label><br>
            <label for="bigStraight">
                <input type="radio" name="scorePosition" id="bigStraight" value="bigStraight" /> Big straight</label><br>
            <label for="house">
                <input type="radio" name="scorePosition" id="house" value="house" /> House</label><br>
            <label for="chance">
                <input type="radio" name="scorePosition" id="chance" value="chance" /> Chance</label><br>
            <label for="yatzy">
                <input type="radio" name="scorePosition" id="yatzy" value="yatzy" /> Yatzy</label><br>
        </form>

        </p>

    <?php endif; ?>

    <div class="diceForm__submit--container">
            <button class="diceForm__input--button diceForm__input--buttonLink" type="submit" name="submit" value="roll">Position points</button>
    </div>
</form>
