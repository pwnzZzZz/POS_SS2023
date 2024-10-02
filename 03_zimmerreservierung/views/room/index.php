<?php
$title = "Zimmerverwaltung";
include '../layouts/top.php';
require_once('../../models/Zimmer.class.php');
?>

    <div class="container">
        <div class="row">
            <h2><?= $title ?></h2>
        </div>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Erstellen <span class="glyphicon glyphicon-plus"></span></a>
            </p>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Zimmernummer</th>
                    <th>Name</th>
                    <th>Personen</th>
                    <th>Preis</th>
                    <th>Balkon</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach (Zimmer::getAll() as $key=>$zimmer){


                    ?>
                <tr>
                    <td><?= $zimmer->getNr()?></td>
                    <td><?= $zimmer->getName()?></td>
                    <td><?= $zimmer->getPersonen()?></td>
                    <td>€ <?= $zimmer->getPreis()?></td>
                    <td><?= ($zimmer->getBalkon()) ?  "Ja" :  "Nein" ?></td>
                    <td><a class="btn btn-info" href="view.php?id=<?= $zimmer->getId() ?>"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;<a
                                class="btn btn-primary" href="update.php?id=<?= $zimmer->getId() ?>"><span
                                    class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a
                                class="btn btn-danger" href="delete.php?id=<?= $zimmer->getId() ?>"><span
                                    class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr><?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div> <!-- /container -->

<?php
include '../layouts/bottom.php';
?>