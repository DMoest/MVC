<?php
/**
 * Provoke an exception to try the exception handler.
 */

include(__DIR__ . "/config.php");

throw new Exception("To try out the default exception handler.");
