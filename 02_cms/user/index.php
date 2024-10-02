<!DOCTYPE html>
<html lang="de">
<?php
include "../../config.php";
include "../helper/head.php";
?>

<body>

<?php
$pathToArticle = "../views/article/index.php";
include "../helper/navbar.php";

require_once("../../models/User.php");

$currentUser = User::get($_SESSION['user']);
?>

<div class="container">
    <h2>Benutzer anzeigen</h2>

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