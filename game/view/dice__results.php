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
$numberOfPlayers = $numberOfPlayers ?? null;
$playerNumber = $playerNumber ?? null;
$graphicDices = $graphicDices ?? null;
$scoreBoard = $scoreBoard ?? null;

?>



<form method="post" action="<?= $action ?>" class="diceForm">
    <h1><?= $header ?></h1>
    <p><i><?= $message ?> - round <?= $round ?></i></p>
    <div class="diceForm__results">
        <h3>Current players score</h3>

        <p>Last played hand from Player <?= $playerNumber ?>
            <!--Graphic Dices -->
            <p class="dice-utf8">
                <?php foreach($graphicDices as $value) : ?>
                    <i class="<?= $value ?>"></i>
                <?php endforeach; ?>
            </p>
        </p>

        <?= $scoreBoard ?>
    </div>

    <div class="diceForm__submit--container">
        <input class="diceForm__input--button diceForm__input--buttonLink" type="submit" name="submit" value="next"/>
    </div>

</form>
