<?php
/**
 * GraphicDice testing.
 */

use \Dicersice\Dice\GraphicDice;

/**
 * Include files.
 * Configuration file and autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload_namespace.php");

$dice = new GraphicDice();
$rolls = 6;
$results = [];
$class = [];

for ($i = 0; $i < $rolls; $i++) {
    $results[] = $dice->roll();
    $class[] = $dice->graphicDice();
}

?><!doctype html>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<h1>Rolling <?= $rolls ?> graphic dices</h1>

<p class="dice-utf8">
    <?php foreach($class as $value) : ?>
        <i class="<?= $value ?>"></i>
    <?php endforeach; ?>
</p>
