<?php
/**
 * Set the error reporting. Only for development environments, remove if site goes into production.
 */

error_reporting(-1); //Report all types of errors.
ini_set("display_errors", 1); //Display all errors.

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
