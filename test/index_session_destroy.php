<?php
/**
 * Destroy the session.
 */

/**
 * Include files.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

session_name("daap19");
session_start();

/* Unset all session variables. */
$_SESSION = [];

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

/* Finally, destroy the session. */
session_destroy();
echo "The session is destroyed. ";
