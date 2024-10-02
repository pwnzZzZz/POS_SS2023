<?php
include "../../config.php";
?>

<!DOCTYPE html>
<html lang="de">
<?php
include "../helper/head.php";
?>

<body>

<?php
$pathToArticle = "index.php";
$pathToIndex = "../../index.php";
include "../helper/navbar.php";
require_once('../../models/Article.php');
require_once('../../models/User.php');
?>

<div class="container">
    <div class="row">
        <h2>Beiträge</h2>
    </div>
    <div class="row">
        <p>
            <a href="create.php" class="btn btn-success">Erstellen <span class="glyphicon glyphicon-plus"></span></a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Titel</th>
                <th>Inhalt</th>
                <th>Besitzer</th>
                <th>Freigabedatum</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                foreach (Article::getAll() as $key => $article) {
                    $user = User::get($article->getUid());
            ?>
            <tr>
                <td><?= $article->getAtitle() ?></td>
                <td><?= $article->getAtext() ?></td>
                <td><?= $user->getUname() ?></td>
                <td><?= $article->getAcreationdate() ?></td>
                <td><a class="btn btn-info" href="view.php?aid=<?= $article->getAid() ?>"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;<a
                            class="btn btn-primary" href="update.php?aid=<?= $article->getAid() ?>"><span
                                class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a
                            class="btn btn-danger" href="delete.php?aid=<?= $article->getAid() ?>"><span
                                class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
            <?php
                }
            } else {
                ?>
                <td>Fehler</td>
                <td>Bitte melden Sie sich an, um die Beiträge sehen zu können.</td>
                <td></td>
                <td></td>
                <td>
                </td>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
</body>
</html>