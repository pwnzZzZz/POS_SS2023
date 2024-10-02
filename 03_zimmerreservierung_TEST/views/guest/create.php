<?php
$title = "Gast anlegen";
include '../layouts/top.php';
require_once('../../models/Gast.php');

$guest = new Gast();

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

        <form class="form-horizontal" action="create.php" method="post">

            <div class="row">
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
                        <label class="control-label">Email *</label>
                        <input type="text" class="form-control" name="email" value="">
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <div class="form-group required ">
                        <label class="control-label">Adresse *</label>
                        <input type="text" class="form-control" name="adresse" value="">
                    </div>
                </div>
                <div class="col-md-1"></div>
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