<?php
/**
 * Provoke self defined exceptions.
 */
use daap19\Dice\Dice;

include(__DIR__ . "/bootstrap.php");
include(__DIR__ . "/../vendor/autoload.php");

try {
    $testDice = new Dice(-150);
    $testDice->roll();
} catch (DiceFaceException $exception) {
    echo "Got exception: " . get_class($exception) . "<hr>";
}

$testDice = new Dice(-15);
