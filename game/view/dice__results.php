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
$round = $round ?? null;
$scoreBoard = $scoreBoard ?? null;
//$output = $output ?? null;
//$players = $players ?? null;
//$playerNumber = $playerNumber ?? null;
//$diceHand = $diceHand ?? null;
//$diceHandLastRoll = $diceHandLastRoll ?? null;
//$roll = $roll ?? null;
//$stop = $stop ?? null;
//$submit = $submit ?? null;
//$diceLastRoll = $diceLastRoll ?? null;

?>

<h1><?= $header ?></h1>
<p><?= $message ?></p>

<form method="post" action="<?= $action ?>" class="diceForm">
    <h3>Round <?= $round ?> results</h3>

    <div class="diceForm__results">
        <h3>Scores</h3>
        <?= $scoreBoard ?>
    </div>

    <div class="diceForm__submit--container">
        <input class="diceForm__input--button" type="submit" name="submit" value="Next round" formaction="dice/view"/>
    </div>
</form>



<!--<p>- TESTING: -------------------------------------------------------------------------------------------------------------</p>-->
<!--<pre>Output: --><?//= var_dump($output) ?><!--</pre>-->
<!--<pre>Action: --><?//= var_dump($action) ?><!--</pre>-->
<!--<pre>$_POST: --><?//= var_dump($_POST) ?><!--</pre>-->
<!--<pre>$_SESSION: --><?//= var_dump($_SESSION) ?><!--</pre>-->
<!--<p>------------------------------------------------------------------------------------------------------------------------</p>-->
