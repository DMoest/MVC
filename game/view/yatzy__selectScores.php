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
$playerRolls = $playerRolls ?? null;
$graphicDices = $graphicDices ?? null;
$playerNumber = $playerNumber ?? null;
$scoreSelection = $scoreSelection ?? null;
$scoreSum = $scoreSum ?? null;

?>



<form method="post" action="<?= $action ?>" class="yatzyForm">
    <h1><?= $header ?></h1>

    <?php if ($graphicDices !== null) : ?>
        <p class="diceForm__results">

        <!-- Present the player -->
        <h3>Player <?= $playerNumber ?></h3>

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

        <p><i><?= $message ?></i></p>

        <!-- Scores selection board included here -->
        <?= $scoreSelection ?>

        <p>Players total score: <b></b><?= $scoreSum ?></b></p>

        </p>
    <?php endif; ?>

    <div class="diceForm__submit--container">
            <button class="diceForm__input--button diceForm__input--buttonLink" type="submit" name="submit">Position points</button>
    </div>
</form>
