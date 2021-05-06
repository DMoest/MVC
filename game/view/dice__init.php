<?php
/**
 * Strict types declaration.
 */
declare(strict_types=1);

/**
 * Declare variables in use.
 * @var string $header representation of the header text.
 * @var string $message representation of the message text.
 * @var string $action full representation of the url-route redirect goes to.
 * @var array $players representation of the action url-route redirect.
 */
$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$output = $output ?? null;
$players = $players ?? null;
$credit = $credit ?? null;

?>


<?php echo " | *** GET *** | " . var_dump($_GET) . "<br>" ?>
<?php echo " | *** POST *** | " . var_dump($_POST) . "<br>" ?>
<?php echo " | *** SESSION *** | " . var_dump($_SESSION) . "<br>" ?>
<?php echo " | *** PLAYERS *** | " . var_dump($players) . "<br>" ?>
<?php echo " | *** DATA *** | " . var_dump($data) . "<br>" ?>


<h2 class="diceForm__text--header"><?= $header ?></h2>

<form method="post" action="<?= $action ?>" class="diceForm">
    <p class="diceForm__text--paragraph"><?= $message ?></p>
    <p>
        <label class="diceForm__text--paragraph" for="players">Number of players in range of 1-5 (excl. computer):
        <input class="diceForm__input--slider" type="range" name="players" placeholder="players" min="1" max="3" value="1"></label><br>
        <p class="diceForm__text--paragraph">This range is 1 to 5 and represents a value for number of players in the game.</p>

        <label class="diceForm__text--paragraph" for="credit">Amount of BitCoins players staring with:
        <input class="diceForm__input--slider" type="number" name="credit" placeholder="players starting credit" min="25" max="100" value="25" step="5"></label><br>

        <label class="diceForm__text--paragraph" for="machine">Play against computer?
        <input class="diceForm__input--checkbox" type="checkbox" name="machine" value="true" checked/></label>
    </p>

    <div class="diceForm__submit--container">
        <button class="diceForm__input--button diceForm__text--button" type="submit">Start game</button>
    </div>

    <?php if ($output !== null) : ?>
        <p>
            <output>You rolled '<?= htmlentities($output) ?>' dices. </output>
        </p>
    <?php endif; ?>
</form>
