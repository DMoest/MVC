<?php
/**
 * Testing class definition with properties.
 *
 * Class Person1.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/src/Person1.php");

$object = new Person1();
$object->age = 35;
$object->name = "Daniel";

echo $object->details();
var_dump($object);
