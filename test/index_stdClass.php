<?php
/**
 * stdClass basics.
 */
include(__DIR__ . "/config.php");

$object = new stdClass();
var_dump($object);

$object = new stdClass();
$object->age = 35;
$object->details = function() {
    echo "Hej hallå där jag är ett objekt! ";
};

echo ($object->details)() . " " . $object->age . " ";
var_dump($object);
