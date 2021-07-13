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
$playerNumber = $playerNumber ?? null;
$scoreBoard = $scoreBoard ?? null;
$playerScores = $playerScores ?? null;
$scoreSum = $scoreSum ?? null;

?>



<h1><?= $header ?></h1>
<p><i><?= $message ?></i></p>

<!-- Print player final scores -->
<?php if ($playerScores !== null) : ?>

    <!-- Present the player -->
    <h3>Player <?= $playerNumber ?> score</h3>

    <!--Show final results -->
    <div>

        <!-- Generate dice representations -->
        <?php foreach($playerScores as $key => $value) : ?>

            <!-- Each graphic dice representation -->
            <div class="">
                <p><?= $key +1 ?>-Dice's points: <?= $value ?></p>
            </div>
        <?php endforeach; ?>

        <!-- Print final score -->
        <h4>Players total score: <?= $scoreSum ?></h4>
    </div>

<?php endif; ?>
