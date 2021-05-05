<?php
/**
 * DiceHand testing.
 */

use \Dicersice\Dice\DiceHand;

/**
 * Include files.
 * Configuration file and autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload_namespace.php");

/* Create new DiceHand object */
$hand = new DiceHand(6, 5);
$hand->rollDices();

?>

<h1>Rolling a hand of dices including <?= count($hand->getDices()); ?> dices</h1>
<p><?= implode(", ", $hand->getResults()) ?></p>
<p>Average value: <?= $hand->getAverage() ?></p>
<p>Total sum of values: <?= $hand->getSum() ?></p>
