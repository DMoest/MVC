<?php
/**
 * Namespace Autoloader.
 */
spl_autoload_register(function ($class) {
    // Echo whats the class to be handled.
    echo "Class: " . "$class<br>";

    // Base directory for the namespace prefix
    $baseDir = __DIR__ . "/src/";
    // echo "Base dir: " . "$baseDir<br>";

    // Get the relative class name
    $offset = strpos($class, "\\") + 1;
    // echo "Offset: " . "$offset<br>";

    // Get the relative class name
    $relativeClass = substr($class, $offset);
    // echo "Relative class: " . "$relativeClass<br>";

    // Replace the namespace prefix with the base dir, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $baseDir . str_replace("\\", "/", $relativeClass) . ".php";
    // echo "File: " . "$file<br>";

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
