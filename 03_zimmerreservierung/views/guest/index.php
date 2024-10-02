<?php
$title = "Gastverwaltung";
include '../layouts/top.php';
require_once('../../models/Gast.class.php');
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
                    <th>Gast-ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach (Gast::getAll() as $key=>$guest){


                    ?>
                <tr>
                    <td><?= $guest->getId()?></td>
                    <td><?= $guest->getName()?></td>
                    <td><?= $guest->getEmail()?></td>
                    <td><?= $guest->getAdresse()?></td>
                    <td><a class="btn btn-info" href="view.php?id=<?= $guest->getId() ?>"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;<a
                                class="btn btn-primary" href="update.php?id=<?= $guest->getId() ?>"><span
                                    class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a
                                class="btn btn-danger" href="delete.php?id=<?= $guest->getId() ?>"><span
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