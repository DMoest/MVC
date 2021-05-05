<?php

namespace Dicersice\Dice;

/**
 * Include files.
 * Configuration file and autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload_namespace.php");

$rolls = $_GET["rolls"] ?? 6;
$dice = new DiceHistogram2();

for ($i = 0; $i < $rolls; $i++) {
    $dice->roll();
}
$histogram = new Histogram();
$histogram->injectData($dice);

?><h1>Display a histogram</h1>

<p><?= implode(", ", $histogram->getSerie()) ?></p>
<pre><?= $histogram->getAsText() ?></pre>
