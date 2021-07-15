<?php
/**
 * Strict types declaration.
 */
declare(strict_types=1);

/**
 * Declare variables in use.
 * @var string $header representation of the header text.
 * @var string $message representation of the message text.
 * @var string $action full representation of the url-route redirect goes to.
 * @var array $players representation of the action url-route redirect.
 */
$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$dices = $dices ?? null;
$players = $players ?? null;
$credit = $credit ?? null;

?>



<form method="post" action="<?= $action ?>" class="diceForm">
    <h2 class="diceForm__text--header"><?= $header ?></h2>
    <p class="diceForm__text--paragraph"><?= $message ?></p>
    <p>
        <label class="diceForm__text--paragraph" for="players">Number of players in range of 1-5 (excl. computer):
        <input class="diceForm__input--slider" type="range" name="players" placeholder="players" min="1" max="3" value="1"></label><br>
        <p class="diceForm__text--paragraph">This range is 1 to 5 and represents a value for number of players in the game.</p>

        <label class="diceForm__text--paragraph" for="credit">Amount of BitCoins players staring with:
        <input class="diceForm__input--slider" type="number" name="credit" placeholder="players starting credit" min="5" max="100" value="25" step="5"></label><br>

        <label class="diceForm__text--paragraph" for="machine">Play against computer?
        <input class="diceForm__input--checkbox" type="checkbox" name="machine" value="true" checked/></label>
    </p>

    <div class="diceForm__submit--container">
        <button class="diceForm__input--button diceForm__input--buttonLink" type="submit">Start game</button>
    </div>
</form>
