<?php
include "config.php";
require_once("models/Article.php");
require_once("models/User.php");


if (isset($_POST['anmelden'])) {
    User::getUserLogin($_POST['uname'], $_POST['upwhash']);
}else if(isset($_POST['abmelden'])){
    User::logout();
    header("Location: index.php");
}



?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>Awesome CMS</title>

    <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
    <link rel="icon" href="css/favicon.ico" type="image/x-icon">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    $pathToIndex = "index.php";
    $pathToArticle = "views/article/index.php";
    include "views/helper/navbar.php";
    ?>
    <div class="jumbotron">
        <div class="container">
            <h1>Hello Awesome CMS!</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Example row of columns -->
            <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                foreach (Article::getAll() as $key => $article) {
            ?>
                    <div class="col-md-4">
                        <h2><?= $article->getAtitle() ?></h2>
                        <p><?= $article->getAtext() ?></p>
                        <p><a class="btn btn-default" href="views/article/view.php?aid=<?= $article->getAid() ?>" role="button">View details &raquo;</a></p>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-md-4">
                    <h2>Artikel</h2>
                    <p>Bitte melden Sie sich an, um die Inhalte sehen zu können.</p>
                </div>
            <?php
            }
            ?>
        </div>
        <hr>

        <footer>
            <p>&copy; 2017 Company, Inc.</p>
        </footer>
    </div> <!-- /container -->

</body>

</html>