<?php
/**
 * Provoke self defined exceptions.
 */

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

try {
    $person = new Person5("Daniel");
    $person->setAge(-35);
} catch (PersonAgeException $exception) {
    echo "Got exception: " . get_class($exception) . "<hr>";
}

$person = new Person5("Daniel", -35);
