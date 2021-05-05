<?php
/**
 * Testing getters & setters for class.
 *
 * Class Person3.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/src/Person3.php");

/* Create new object from class */
$object = new Person3();

/* Use setter of class to declare name & age */
$object->setName("Daniel");
$object->setAge(35);
?>

/* Show details about new object */
<p>Details: <?= $object->details(); ?> </p>
<p>Name: <?= $object->getName(); ?></p>
<p>Age: <?= $object->getAge(); ?> </p>
