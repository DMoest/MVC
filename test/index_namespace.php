<?php
/**
 * Namespace testing.
 */

/**
 * Include files.
 * Configuration file and autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload_namespace.php");

$object = new \Daap19\Person\Person("MegaMic", 42);
echo $object->details();
var_dump($object);
