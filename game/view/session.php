<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$url = url("/session/destroy");

echo <<<EOD
<h1>Session details</h1>
<p>Here are some details on the session. Reload this page to see the counter increment itself.</p>
<p>You may <a href="$url">destroy the session</a> if you like, good for dealing
with trouble.</p>
EOD;

?>

<p> <?php var_dump(session_name()); ?></p><br>";
<pre>$_SESSION["counter"]: <?php print_r($_SESSION); ?></pre><br>";

<p><?php $_SESSION["counter"] = 1 + ($_SESSION["counter"] ?? 0); ?></p>

<pre>$_POST: <?php print_r($_POST); ?></pre><br>";
