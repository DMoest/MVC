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

<form method="post" action="<?= $action ?>" class="yatzyForm">
    <p>Player rolled the dices: <?= $playerRolls ?> times.</p>

    <?php if ($graphicDices !== null) : ?>
        <p class="diceForm__results">

        <!-- Present the player -->
        <h3>Player <?= $playerNumber ?> score</h3>

        <!--Graphic Dices -->
        <div class="diceForm__graphicDices">

            <!-- Generate dice representations -->
            <?php foreach($graphicDices as $key => $value) : ?>

                <!-- Each graphic dice representation -->
                <div class="dice-utf8 diceForm__graphicDices--selectionBox">
                    <i class="<?= $value ?>"></i>
                </div>
            <?php endforeach; ?>
        </div>

        <p><i>Select where on the chart to place your points.</i></p>

        <label class=""yatzyForm__input--label" for="one">
            <input class="yatzyForm__input--radio" type="radio" name="one" id="one" value="one" /> One</label><br>
        <label class=""yatzyForm__input--label" for="two">
            <input class="yatzyForm__input--radio" type="radio" name="two" id="two" value="two" /> Two</label><br>
        <label class=""yatzyForm__input--label" for="three">
            <input class="yatzyForm__input--radio" type="radio" name="three" id="three" value="three" /> Three</label><br>
        <label class=""yatzyForm__input--label" for="four">
            <input class="yatzyForm__input--radio" type="radio" name="four" id="four" value="four" /> Four</label><br>
        <label class=""yatzyForm__input--label" for="five">
            <input class="yatzyForm__input--radio" type="radio" name="five" id="five" value="five" /> Five</label><br>
        <label class=""yatzyForm__input--label" for="six">
            <input class="yatzyForm__input--radio" type="radio" name="six" id="six" value="six" /> Six</label><br>





<!--            <hr>-->
<!---->
<!--            <label class="yatzyForm__input--label" for="onePair">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="onePair" value="onePair" /> One pair</label><br>-->
<!--            <label class="yatzyForm__input--label" for="three">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="three" value="twoPairs" /> Two pairs</label><br>-->
<!--            <label class="yatzyForm__input--label" for="threeOfAKind">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="threeOfAKind" value="threeOfAKind" /> Three of a Kind</label><br>-->
<!--            <label class="yatzyForm__input--label" for="fourOfAKind">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="fourOfAKind" value="fourOfAKind" /> Four of a Kind</label><br>-->
<!--            <label class="yatzyForm__input--label" for="smallStraight">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="smallStraight" value="smallStraight" /> Small straight</label><br>-->
<!--            <label class="yatzyForm__input--label" for="bigStraight">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="bigStraight" value="bigStraight" /> Big straight</label><br>-->
<!--            <label class="yatzyForm__input--label" for="house">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="house" value="house" /> House</label><br>-->
<!--            <label class="yatzyForm__input--label" for="chance">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="chance" value="chance" /> Chance</label><br>-->
<!--            <label class="yatzyForm__input--label" for="yatzy">-->
<!--                <input class="yatzyForm__input--radio" type="radio" name="scorePosition" id="yatzy" value="yatzy" /> Yatzy</label><br>-->


        </p>

    <?php endif; ?>

    <div class="diceForm__submit--container">
            <button class="diceForm__input--button diceForm__input--buttonLink" type="submit" name="submit">Position points</button>
    </div>
</form>
