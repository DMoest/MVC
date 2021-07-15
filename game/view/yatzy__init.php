<?php
/**
 * Strict types declaration.
 */
declare(strict_types=1);

/**
 * Declare variables in use.
 * @var string $header representation of the header text.
 * @var string $action full representation of the url-route redirect goes to.
 * @var string $message representation of the message text.
 */
$header = $header ?? null;
$action = $action ?? null;
$message = $message ?? null;

?>




<form method="post" action="<?= $action ?>" class="diceForm">
    <h2 class="diceForm__text--header"><?= $header ?></h2>
    <p class="diceForm__text--paragraph"><?= $message ?></p>

    <div class="diceForm__submit--container">
        <button class="diceForm__input--button diceForm__input--buttonLink" type="submit">Start game</button>
    </div>
</form>
