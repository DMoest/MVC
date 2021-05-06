<?php

/**
 * Setup the basis for the environment.
 */

declare(strict_types=1);

// Setup error reporting
error_reporting(-1);                // Report all type of errors
ini_set("display_errors", "1");     // Display all errors

/**
 * Default exception handler.
 */
set_exception_handler(function ($exception) {
    echo "<p>Anax: Uncaught exception: </p><p>Line "
        . $exception->getLine()
        . " in file "
        . $exception->getFile()
        . "</p><p><code>"
        . get_class($exception)
        . "</code></p><p>"
        . $exception->getMessage()
        . "</p><pre>"
        .$exception->getCode()
        . "</p><pre>"
        . $exception->getTraceAsString()
        . "</pre>";
});

// Start the session
session_name(preg_replace("/[^a-z\d]/i", "", __DIR__));
session_start();
