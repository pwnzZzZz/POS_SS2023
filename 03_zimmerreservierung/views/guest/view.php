<?php
$title = "Gast anzeigen";
include '../layouts/top.php';
require_once('../../models/Gast.class.php');

$guest = new Gast();

if(isset($_GET['id'])){
    $guest = Gast::get($_GET['id']);
}

?>

    <div class="container">
        <h2><?= $title ?></h2>

        <p>
            <a class="btn btn-primary" href="update.php?id=29">Aktualisieren</a>
            <a class="btn btn-danger" href="delete.php?id=29">Löschen</a>
            <a class="btn btn-default" href="index.php">Zurück</a>
        </p>

        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <tr>
                <th>Zimmernummer</th>
                <td><?= $guest->getId() ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $guest->getName() ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $guest->getEmail() ?></td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>€ <?= $guest->getAdresse() ?></td>
            </tr>
            </tbody>
        </table>
    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>