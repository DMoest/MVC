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
$round = $round ?? null;
$action = $action ?? null;
$scoreBoard = $scoreBoard ?? null;

?>



<h1><?= $header ?></h1>
<p><i><?= $message ?> - round <?= $round ?></i></p>

<form method="post" action="<?= $action ?>" class="diceForm">

    <!-- Print score board -->
    <?= $scoreBoard ?>

    <!-- Next button -->
    <div class="diceForm__submit--container">
        <input class="diceForm__input--button diceForm__input--buttonLink" type="submit" name="submit" value="next"/>
    </div>
</form>
