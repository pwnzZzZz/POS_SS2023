<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Passwortmanager</title>

    <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
    <link rel="icon" href="css/favicon.ico" type="image/x-icon">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <h2>Passwortmanager</h2>
    </div>
    <div class="row">
        <p>
            <a href="create.php" class="btn btn-success">Erstellen <span class="glyphicon glyphicon-plus"></span></a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Domäne</th>
                <th>CMS-Benutzername</th>
                <th>CMS-Passwort</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            require_once("models/Credentials.php");

            $credentials = Credentials::getAll();

            foreach($credentials as $c) {
                echo '<tr>';
                echo '<td>' . $c->getName() . '</td>';
                echo '<td>' . $c->getDomain() . '</td>';
                echo '<td>' . $c->getCms_username() . '</td>';
                echo '<td>' . $c->getCms_password() . '</td>';
                echo '<td><a class="btn btn-info" href="view.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;
                        <a class="btn btn-primary" href="update.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
                        <a class="btn btn-danger" href="delete.php?id=' . $c->getId() . '"><span class="glyphicon glyphicon-remove"></span></a>&nbsp;
                    </td>';
                echo '</tr>';
            }
            ?>
            
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
</body>
</html>