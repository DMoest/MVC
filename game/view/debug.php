<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\{
    getBaseUrl,
    getCurrentUrl,
    getRoutePath
};

echo "<h1>Debug details</h1>"; ?>

<pre><?= var_dump(getBaseUrl()); ?></pre>
<pre><?= var_dump(getCurrentUrl()); ?></pre>
<pre><?= var_dump(getRoutePath()); ?></pre>
<pre><?= var_dump($_SERVER); ?></pre>



<!--var_dump(getBaseUrl());-->
<!--var_dump(getCurrentUrl());-->
<!--var_dump(getRoutePath());-->
<!--var_dump($_SERVER);-->
