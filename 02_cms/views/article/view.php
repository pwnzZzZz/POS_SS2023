<!DOCTYPE html>
<html lang="de">
<?php
include "../../config.php";
include "../helper/head.php";
?>

<body>

<?php
$pathToArticle = "index.php";
$pathToIndex = "../../index.php";
include "../helper/navbar.php";

require_once("../../models/Article.php");
require_once("../../models/User.php");

$article = null;

if(isset($_GET['aid'])) {
    $article = Article::get($_GET['aid']);
    $user = User::get($article->getUid());
}
?>

<div class="container">
    <h2>Beitrag anzeigen</h2>

    <p>
        <a class="btn btn-primary" href="update.php?aid=<?= $article->getAid() ?>">Aktualisieren</a>
        <a class="btn btn-danger" href="delete.php?aid=<?= $article->getAid() ?>">Löschen</a>
        <a class="btn btn-default" href="javascript:history.back()">Zurück</a>
    </p>

    <?php
        if($article != null) {
    ?>
    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Titel</th>
            <td><?= $article->getAtitle() ?></td>
        </tr>
        <tr>
            <th>Freigabedatum</th>
            <td><?= $article->getACreationdate() ?></td>
        </tr>
        <tr>
            <th>Besitzer</th>
            <td><?= $user->getUname() ?></td>
        </tr>
        <tr>
            <th>Inhalt</th>
            <td><?= $article->getAtext() ?></td>
        </tr>
        </tbody>
    </table>
    <?php
        } else {
            ?>
            <div class="col-md-4">
                <h2>Artikel</h2>
                <p>Bitte melden Sie sich an, um die Inhalte sehen zu können.</p>
            </div>
        <?php
        }
        ?>
</div> <!-- /container -->
</body>
</html>