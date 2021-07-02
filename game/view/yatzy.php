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

            <!--Graphic Dices -->
            <div class="diceForm__graphicDices">

                <!-- Generate dice representations -->
                <?php foreach($graphicDices as $key => $value) : ?>
                    <!-- Each graphic dice representation -->
                    <div class="dice-utf8 diceForm__graphicDices--selectionBox">
                        <i class="<?= $value ?>"></i>
                        <?php if ($playerRolls !== 3) : ?>
                            <input class="diceForm__input--checkbox" id="dice--<?= $key ?>" name="dice--<?= $key ?>" type="checkbox"/>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>
            </div>
            <p><i>Select dices to keep at next throw of dices.</i></p>
        </p>
    <?php endif; ?>

    <div class="diceForm__submit--container">
        <?php if($playerRolls < 3) : ?>
            <button class="diceForm__input--button diceForm__input--buttonSuccess" type="submit" name="submit" value="roll">Roll the dices</button>
            <button class="diceForm__input--button diceForm__input--buttonDanger" type="submit" name="submit" value="stop">Stop</button>
        <?php endif; ?>

        <?php if($playerRolls === 3) : ?>
            <button class="diceForm__input--button diceForm__input--buttonSuccess" type="submit" name="submit" value="selectScores">Select scores</button>
        <?php endif; ?>
    </div>
</form>
