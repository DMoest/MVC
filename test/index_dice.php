<?php
/**
 * Dice testing.
 */

/**
 * Include files.
 * Configuration file and autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload_namespace.php");

use \Dicersice\Dice\Dice;

$object = new Dice(6);

?>

<h1>Rolling the dice six times</h1>
<ol>

<?php
for($i = 0; $i < 6; $i++)
{
    $object->roll(); ?>

    <li><?= $object->getLastRoll(); ?></li>

    <?php
}

$average = round(array_sum($object->getResults()) / $object->getNumberOfRolls(), 2);

?>

</ol>

<p>Total sum: <?= $object->getSumOfRolls(); ?></p>
<p>Average value: <?= $average ?></p>
