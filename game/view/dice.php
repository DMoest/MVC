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
$dices = $dices ?? null;
$submit = $submit ?? null;
$round = $round ?? null;
$players = $players ?? null;
$playerNumber = $playerNumber ?? null;
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
    <p>Round: <?= $round ?></p>
    <p>It's Player <?= $playerNumber ?> </p>
    <p>Player <?= $playerNumber ?> score is: <?= $score ?></p>
<!--    <p>Player --><?//= $playerNumber ?><!-- credit: --><?//= $credit ?><!--</p>-->

    <p>
        <label class="diceForm__text--paragraph" for="dices">Number of dices:
        <input class="diceForm__input--slider" type="range" name="dices" min="1" max="2" value="1" class="diceForm__input--slider">
        <p><i>This range is 1-2 for the dices to be rolled.</i></p></label>
    </p>

    <div class="diceForm__submit--container">
        <button class="diceForm__input--button diceForm__input--buttonSuccess" type="submit" name="submit" value="roll">Roll the dices</button>
        <button class="diceForm__input--button diceForm__input--buttonDanger" type="submit" name="submit" value="stop">Stop</button>
    </div>
</form>



<!-- ------------------------------------------------------------------------------------------------------------------------ -->
<!--<h3>| *** DICE VIEW *** |</h3>-->
<!---->
<!--<p>| *** POST *** |</p>-->
<!--<pre>--><?php //print_r($_POST) ?><!--</pre>-->
<!---->
<!--<p>| *** SESSION *** |</p>-->
<!--<pre>--><?php //print_r($_SESSION) ?><!--</pre>-->

<!-- ------------------------------------------------------------------------------------------------------------------------ -->
