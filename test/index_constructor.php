<?php
/**
 * Testing constructor for class.
 *
 * Class Person4.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/src/Person4.php");

$object1 = new Person4("Daniel", 35);
$object2 = new Person4("Daniel");
$object3 = new Person4();
?>

<p>Details: <?= $object1->details(); ?></p>
<p>Details: <?= $object2->details(); ?></p>
<p>Details: <?= $object3->details(); ?></p>
<p><?= var_dump($object1); ?></p>
<p><?= var_dump($object2); ?></p>
<p><?= var_dump($object3); ?></p>
