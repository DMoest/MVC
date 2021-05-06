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
$credit = $credit ?? null;

?>

<h1><?= $header ?></h1>
<p><?= $message ?></p>
<p><?= $output ?></p>
<p><?= $players ?></p>
<p><?= $credit ?></p>

<form method="post" action="<?= $action ?>" class="diceForm">
    <p>
        <label for="dices">Number of players in range of 1-5 (excl. computer): </label>
        <input class="diceForm__input--slider" type="range" name="numberOfPlayers" placeholder="dices" min="1" max="3" value="1">
        <p>This range is 1 to 5 and represents a value for number of players in the game.</p>

        <label for="credit">Amount of BitCoins players staring with: </label>
        <input class="diceForm__input--slider" type="number" name="credit" placeholder="players starting credit" min="25" max="100" value="25" step="5">
    </p>

    <div class="diceForm__submit--container">
        <button class="diceForm__input--button" type="submit">Start game</button>
    </div>

    <?php if ($output !== null) : ?>
        <p>
            <output>You rolled '<?= htmlentities($output) ?>' dices. </output>
        </p>
    <?php endif; ?>
</form>
