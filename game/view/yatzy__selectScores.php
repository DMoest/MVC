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



<h1><?= $header ?></h1>
<p><i><?= $message ?></i></p>

<form method="post" action="<?= $action ?>" class="yatzyForm">
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
                </div>
            <?php endforeach; ?>
        </div>

        <p><i>Select where on the chart to place your points.</i></p>

        <?= $scoreSelection ?>
        <p>Players total score: <?= $scoreSum ?></p>

        </p>
    <?php endif; ?>

    <div class="diceForm__submit--container">
            <button class="diceForm__input--button diceForm__input--buttonLink" type="submit" name="submit">Position points</button>
    </div>
</form>
