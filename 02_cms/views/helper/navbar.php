<?php

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

$path = pathinfo($_SERVER['REQUEST_URI']);

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Awesome CMS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= $pathToArticle ?>">Beiträge</a></li>
                <li><a href="#">Benutzer</a></li>
            </ul>
            <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            ?>
                <form action="<?= $pathToIndex ?> " method="POST" class="navbar-form navbar-right">
                    <button type="submit" name="abmelden" class="btn btn-warning">Abmelden</button>
                </form>
                
            <?php
            } else {
            ?>
                <form action="index.php" method="POST" class="navbar-form navbar-right">
                    <label for="uname">Username</label>
                    <input name="uname" type="text" class="form-group">
                    <label for="upwhash">Password</label>
                    <input name="upwhash" type="password" class="form-group">
                    <button type="submit" name="anmelden" class="btn btn-success">Anmelden</button>
                </form>
                
            <?php
            }
            ?>

        </div><!--/.navbar-collapse -->
    </div>
</nav>
<br><br>