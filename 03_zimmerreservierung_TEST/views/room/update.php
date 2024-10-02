<?php
$title = "Zimmer bearbeiten";
include '../layouts/top.php';
require_once('../../models/Zimmer.php');

$room = new Zimmer();



if(isset($_GET['id'])){
    $room = Zimmer::get($_GET['id']);
}

if(isset($_POST['submit'])){
    $room->setNr($_POST['nr']);
    $room->setName($_POST['name']);
    $room->setPersonen($_POST['nr']);
    $room->setPreis($_POST['preis']);
    $room->setBalkon($_POST['balkon']);

    $room->update();

    header("Location: index.php");
}

?>

<div class="container">
    <div class="row">
        <h2><?= $title ?></h2>
    </div>

    <form class="form-horizontal" action="update.php?id=<?= $room->getId() ?>" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label">Zimmernummer *</label>
                    <input type="text" class="form-control" name="nr" maxlength="4" value=<?= $room->getNr() ?> readonly>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="form-group required ">
                    <label class="control-label">Name *</label>
                    <input type="text" class="form-control" name="name" maxlength="64" value=<?= $room->getName() ?>>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label">Personen *</label>
                    <input type="number" class="form-control" name="personen" min="1" value=<?= $room->getPersonen() ?>>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required ">
                    <label class="control-label">Preis *</label>
                    <input type="text" class="form-control" name="preis" value=<?= $room->getPreis() ?>>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1">
                <div class="form-group required ">
                    <label class="control-label">Balkon *</label>
                    <input type="checkbox" class="form-control" name="balkon" <?= $room->getBalkon() ? 'checked' : '' ?> >
                </div>
            </div>
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
