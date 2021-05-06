<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use daap19\Dice\Dice;

for ($i = 0; $i < 9; $i++) {
    $dice = new Dice();
    $dice->roll();

    echo $dice->getLastRoll() . ", ";
}
