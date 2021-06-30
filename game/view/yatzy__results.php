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

<h1><?= $header ?></h1>
<p><i><?= $message ?> - round <?= $round ?></i></p>

<form method="post" action="<?= $action ?>" class="diceForm">

    <!-- Print score board -->
    <?= $scoreBoard ?>

    </div>

    <!-- Next button -->
    <div class="diceForm__submit--container">
        <input class="diceForm__input--button diceForm__input--buttonLink" type="submit" name="submit" value="next"/>
    </div>
</form>



<!-- ------------------------------------------------------------------------------------------------------------------------ -->
<!--<h3>| *** DICE RESULTS VIEW *** |</h3>-->
<!---->
<!--<p>| *** POST *** |</p>-->
<!--<pre>--><?php //print_r($_POST) ?><!--</pre>-->
<!---->
<!--<p>| *** SESSION *** |</p>-->
<!--<pre>--><?php //print_r($_SESSION) ?><!--</pre>-->

<!-- ------------------------------------------------------------------------------------------------------------------------ -->
