<?php

function contains($haystack, $needle)
{
    return stripos($haystack, $needle) !== FALSE;
}

$path = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_DIRNAME);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>

    <link rel="shortcut icon" href="../../css/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../css/favicon.ico" type="image/x-icon">

    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/index.css" rel="stylesheet">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Zimmerreservierung</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">Reservierungen</a></li>
                <li><a href="#">Gäste</a></li>
                <li <?= contains($path, "index") ? 'class="active"' : '' ?>><a href="#">Zimmer</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Hilfe</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>