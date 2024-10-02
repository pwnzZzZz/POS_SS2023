<!DOCTYPE html>
<html lang="de">
<?php
include "../helper/head.php";
include "../../config.php";
?>

<body>

<?php
$pathToArticle = "index.php";
$pathToIndex = "../../index.php";
include "../helper/navbar.php";
require_once('../../models/Article.php');
require_once('../../models/User.php');

$currentUser = User::get($_SESSION['user']);

$a = Article::get($_GET['aid']);

if(isset($_POST['delete'])) {
    Article::delete($_POST['id']);
    header("Location: index.php");
}

?>

<div class="container">
    <h2>Beitrag löschen</h2>
    <?php
        if ($currentUser->getUid() == $a->getUid()) {
        ?>
    <form class="form-horizontal" action="delete.php?aid=<?= $a->getAid() ?>" method="post">
        <input type="hidden" name="id" value="<?= $a->getAid() ?>"/>
        <p class="alert alert-error">Wollen Sie den Beitrag wirklich löschen?</p>
        <div class="form-actions">
            <button type="submit" name="delete" class="btn btn-danger">Löschen</button>
            <a class="btn btn-default" href="javascript:history.back()">Abbruch</a>
        </div>
    </form>

    <?php
        } else {
        ?>
            <div class="row">
                <h3>Beiträge können nur vom Verfasser gelöscht werden!</h3>
            </div>
            <div class="row">
                <a href="javascript:history.back()" class="btn btn-danger" role="button"><span>Zurück</span></a>
            </div>
        <?php
        }
        ?>

</div> <!-- /container -->
</body>
</html>