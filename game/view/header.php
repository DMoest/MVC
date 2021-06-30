<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="nofollow">
    <meta name="description" content="Assignments for the course MVC @ Blekinge Institute of Technology.">
    <meta http-equiv="author" content="Daniel Andersson, daap19">

    <title><?= $title ?? "MVC - daap19" ?></title>
    <link rel="icon" href="<?= url("/favicon.ico") ?>">
    <link rel="stylesheet" type="text/css" href="<?= url("/css/style.css") ?>">
</head>

<body>

<header class="header">
    <div class="header__title">
        <h1 class="header__title--text">MVC</h1>
        <p class="header__title--slogan">test site for daap19</p>
    </div>

    <nav class="navbar">
        <a href="<?= url("/") ?>" class="navbar__button">Home</a>
        <a href="<?= url("/session") ?>" class="navbar__button">Session</a>
        <a href="<?= url("/debug") ?>" class="navbar__button">Debug</a>
        <a href="<?= url("/twig") ?>" class="navbar__button">Twig view</a>
        <a href="<?= url("/some/where") ?>" class="navbar__button">some/where</a>
        <a href="<?= url("/no/such/path") ?>" class="navbar__button">Show 404 example</a>
        <a href="<?= url("/form/view") ?>" class="navbar__button">Form view</a>
        <a href="<?= url("/dice__init/view") ?>" class="navbar__button">Dice</a>
        <a href="<?= url("/yatzy__init/view") ?>" class="navbar__button">Yatzy</a>
    </nav>
</header>

<main>
