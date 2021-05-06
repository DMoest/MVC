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
$output = $output ?? null;
$players = $players ?? null;
$playerNumber = $playerNumber ?? null;
$round = $round ?? null;
$diceHand = $diceHand ?? null;
$diceHandLastRoll = $diceHandLastRoll ?? null;
$graphicDices = $graphicDices ?? null;
$scoreBoard = $scoreBoard ?? null;

?>



<h1><?= $header ?></h1>
<p><?= $message ?></p>
<p>There are <?= count($players) ?> players in this game of Dice 21.</p>
<p>Round: <?= $round ?></p>

<form method="post" action="<?= $action ?>" class="diceForm">
    <h3>It is Player <?= $playerNumber ?>'s turn to roll the dices</h3>
    <pre>
        <label for="dices">Number of dices: </label>
        <input  type="range" name="content" min="0" max="2" value="1" class="diceForm__input--slider">
        <p><i>This range is 0-2. (0 = STOP, 1 or 2 = dices to be rolled).</i></p>
    </pre>

    <div class="diceForm__submit--container">
        <input class="diceForm__input--button" type="submit" name="submit" value="Make move"/>
    </div>

    <?php if ($output !== null) : ?>
        <?php if (intval($output) !== 0) : ?>
            <p>
            <!-- Dices rolled -->
                <output>Last hand of <?= htmlentities($output) ?> dices rolled: </output>
            <p><?= $diceHandLastRoll ?></p>

            <!--Graphic Dices -->
            <p class="dice-utf8">
                <?php foreach($graphicDices as $value) : ?>
                    <i class="<?= $value ?>"></i>
                <?php endforeach; ?>
            </p>

            <!-- ScoreBoard -->
            <div class="diceForm__results">
                <h3>Scores</h3>
                <?= $scoreBoard ?>
            </div>
        <?php elseif (intval($output) === 0) : ?>
            <!-- Message for player stopped -->
            <p>
                <output>Player <?= $playerNumber ?> STOPPED here!<br> <?= htmlentities($output) ?> dices where rolled.</output>
            <p><?= $diceHandLastRoll ?></p>

            <div class="diceForm__results">
                <h3>Scores</h3>
                <?= $scoreBoard ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</form>



<!--<p>- TESTING: -------------------------------------------------------------------------------------------------------------</p>-->
<!--<pre>Output: --><?//= var_dump($output) ?><!--</pre>-->
<!--<pre>Action: --><?//= var_dump($action) ?><!--</pre>-->
<!--<pre>$_POST: --><?//= var_dump($_POST) ?><!--</pre>-->
<!--<pre>$_SESSION: --><?//= var_dump($_SESSION) ?><!--</pre>-->
<!--<p>------------------------------------------------------------------------------------------------------------------------</p>-->
