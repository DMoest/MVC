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
    <title><?= $title ?? "MVC - Kmom01 - daap19" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="nofollow">
    <meta name="description" content="Assignment Kmom01 for the course MVC @ Blekinge Institute of Technology. In this part of the course we are building a game with object oriented programing to roll them dices to compete the computer for points.">
    <meta http-equiv="author" content="Daniel Andersson, daap19">
    <link rel="icon" href="<?= url("/favicon.ico") ?>">
    <link rel="stylesheet" type="text/css" href="<?= url("/css/style.css") ?>">
</head>

<body>

<header class="header">
    <div class="header__title">
        <h1 class="header__title--text">MVC</h1>
        <p class="header__title--slogan">Kmom01 - frontcontroller</p>
    </div>

    <nav class="navbar">
        <a class="navbar__button" href="<?= url("/") ?>">Home</a> |
        <a class="navbar__button" href="<?= url("/session") ?>">Session</a> |
        <a class="navbar__button" href="<?= url("/debug") ?>">Debug</a> |
        <a class="navbar__button" href="<?= url("/twig") ?>">Twig view</a> |
        <a class="navbar__button" href="<?= url("/some/where") ?>">some/where</a> |
        <a class="navbar__button" href="<?= url("/no/such/path") ?>">Show 404 example</a> |
        <a class="navbar__button" href="<?= url("/form/view") ?>">Form view</a> |
<!--        <a class="navbar__button" href="--><?//= url("/dice") ?><!--">Dice</a>-->
    </nav>
</header>
<main>
