<?php
$title = "Zimmer löschen";
include '../layouts/top.php';
require_once('../../models/Zimmer.class.php');

$room = new Zimmer();

if(isset($_GET['id'])){
    $room = Zimmer::get($_GET['id']);
}

if(isset($_POST['submit'])){
    $room->delete($_POST['id']);
    header("Location: index.php");
}

?>

    <div class="container">
        <h2><?= $title ?></h2>

        <form class="form-horizontal" action="delete.php?id=<?= $room->getId() ?>" method="post">
            <input type="hidden" name="id" value=<?= $room->getId() ?>/>
            <p class="alert alert-error">Wollen Sie das Zimmer wirklich löschen?</p>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn btn-danger">Löschen</button>
                <a class="btn btn-default" href="index.php">Abbruch</a>
            </div>
        </form>

    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>