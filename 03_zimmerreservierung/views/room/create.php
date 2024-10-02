<?php
$title = "Zimmer erstellen";
include '../layouts/top.php';

require_once('../../models/Zimmer.class.php');

$room = new Zimmer();

if(isset($_POST['submit'])){
    $room->setNr(isset($_POST['nr']) ? $_POST['nr'] : 0);
    $room->setName(isset($_POST['name']) ? $_POST['name'] : '');
    $room->setPersonen(isset($_POST['personen']) ? $_POST['personen'] : 0);
    $room->setPreis(isset($_POST['preis']) ? $_POST['preis'] : 0.0);
    $room->setBalkon(isset($_POST['balkon']) ? TRUE : FALSE);

    $room->create();

    header("Location: index.php");
}

?>

    <div class="container">
        <div class="row">
            <h2><?= $title ?></h2>
        </div>

        <form class="form-horizontal" action="create.php" method="post">

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group required ">
                        <label class="control-label">Zimmernummer *</label>
                        <input type="text" class="form-control" name="nr" maxlength="4" value="">
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div class="form-group required ">
                        <label class="control-label">Name *</label>
                        <input type="text" class="form-control" name="name" maxlength="64" value="">
                    </div>
                </div>
                <div class="col-md-5"></div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group required ">
                        <label class="control-label">Personen *</label>
                        <input type="number" class="form-control" name="personen" min="1" value="">
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <div class="form-group required ">
                        <label class="control-label">Preis *</label>
                        <input type="text" class="form-control" name="preis" value="">
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-1">
                    <div class="form-group required ">
                        <label class="control-label">Balkon *</label>
                        <input type="checkbox" class="form-control" name="balkon" value="">
                    </div>
                </div>
                <div class="col-md-5"></div>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success">Erstellen</button>
                <a class="btn btn-default" href="index.php">Abbruch</a>
            </div>
        </form>

    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>