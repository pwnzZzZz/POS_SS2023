<?php
$title = "Gast löschen";
include '../layouts/top.php';

require_once('../../models/Gast.php');

$guest = new Gast();

if(isset($_GET['id'])){
    $guest = Gast::get($_GET['id']);
}

if(isset($_POST['submit'])){
    Gast::delete($_POST['id']);

    header("Location: index.php");
}


?>

    <div class="container">
        <h2><?= $title ?></h2>

        <form class="form-horizontal" action="delete.php?id=<?= $guest->getId() ?>" method="post">
            <input type="hidden" name="id" value=<?= $guest->getId() ?>/>
            <p class="alert alert-error">Wollen Sie den Gast wirklich löschen?</p>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-danger">Löschen</button>
                <a class="btn btn-default" href="index.php">Abbruch</a>
            </div>
        </form>

    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>