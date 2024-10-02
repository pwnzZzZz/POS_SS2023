<?php
$title = "Gast bearbeiten";
include '../layouts/top.php';
require_once('../../models/Gast.php');

$guest = new Gast();



if(isset($_GET['id'])){
    $guest = Gast::get($_GET['id']);
}

if(isset($_POST['submit'])){
    $guest->setName($_POST['name']);
    $guest->setEmail($_POST['email']);
    $guest->setAdresse($_POST['adresse']);

    $guest->save();

    header("Location: index.php");
}

?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>

    <form class="form-horizontal" action="update.php?id=<?= $guest->getId() ?>" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label">Gast-ID *</label>
                    <input type="text" class="form-control" name="id" maxlength="4" value=<?= $guest->getId() ?> readonly>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="64" value=<?= $guest->getName() ?>>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label">Email *</label>
                    <input type="number" class="form-control" name="email" min="1" value=<?= $guest->getEmail() ?>>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label">Adresse *</label>
                    <input type="text" class="form-control" name="adresse" value=<?= $guest->getAdresse() ?>>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5"></div>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="index.php">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>
