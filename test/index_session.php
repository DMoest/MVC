<?php

/**
 * Start session.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");


session_name("daap19");
session_start();

/* Unset all session variables */
$_SESSION = [];

if (!isset($_SESSION["person"])) {
    $_SESSION["person"] = new Person5("Daniel", 35);
}

$person = $_SESSION["person"];
$age = $person->getAge();
$person->setAge($age + 1);

echo $person->details();
