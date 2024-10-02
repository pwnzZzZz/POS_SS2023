<?php
$title = "Zimmer anzeigen";
include '../layouts/top.php';

require_once('../../models/Zimmer.php');

$room = new Zimmer();

if(isset($_GET['id'])){
    $room = Zimmer::get($_GET['id']);
}

?>

    <div class="container">
        <h2><?= $title ?></h2>

        <p>
            <a class="btn btn-primary" href="update.php?id=<?= $room->getId()?>">Aktualisieren</a>
            <a class="btn btn-danger" href="delete.php?id=<?= $room->getId()?>">Löschen</a>
            <a class="btn btn-default" href="index.php">Zurück</a>
        </p>

        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <tr>
                <th>Zimmernummer</th>
                <td><?= $room->getNr() ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $room->getName() ?></td>
            </tr>
            <tr>
                <th>Personen</th>
                <td><?= $room->getPersonen() ?></td>
            </tr>
            <tr>
                <th>Preis</th>
                <td>€ <?= $room->getPreis() ?></td>
            </tr>
            <tr>
                <th>Balkon</th>
                <td><?= $room->getBalkon() ? 'JA' : 'NEIN' ?></td>
            </tr>
            </tbody>
        </table>
    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>