<!DOCTYPE html>
<html lang="de">
<?php
include "../helper/head.php";
include "../../config.php";
?>

<body>

    <?php
    $pathToArticle = "index.php";
    $pathToIndex = "../../index.php";
    include "../helper/navbar.php";

    require_once('../../models/Article.php');
    require_once('../../models/User.php');

    $currentUser = User::get($_SESSION['user']);

    if (isset($_GET['aid'])) {
        $a = Article::get($_GET['aid']);

        $_SESSION['currentArticle'] = serialize($a);
    }


    if (isset($_POST['submit'])) {
        $a = unserialize($_SESSION['currentArticle']);
        $a->setAtitle(isset($_POST['title']) ? $_POST['title'] : '');
        $a->setAtext(isset($_POST['content']) ? $_POST['content'] : '');
        $a->setAcreationdate(isset($_POST['releasedate']) ? $_POST['releasedate'] : '');
        $a->setUid(isset($_POST['owner']) ? $_POST['owner'] : '');

        $a->save();

        header("Location: view.php?aid=" . $a->getAid());
    }
    ?>

    <div class="container">
        <div class="row">
            <h2>Beitrag bearbeiten</h2>
        </div>

        <?php
        if ($currentUser->getUid() == $a->getUid()) {
        ?>
            <form class="form-horizontal" action="update.php" method="post">

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group required">
                            <label class="control-label">Titel *</label>
                            <input type="text" class="form-control" name="title" maxlength="100" value="<?= $a->getAtitle() ?>">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <div class="form-group required">
                            <label class="control-label">Freigabedatum *</label>
                            <input type="date" class="form-control" name="releasedate" value="<?= $a->getAcreationdate() ?>">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label class="control-label">Besitzer *</label>
                            <select class="form-control" name="owner">
                                <option value="">-Besitzer auswählen-</option>
                                <?php
                                foreach (User::getAll() as $key => $user) {
                                    echo '<option value="' . $user->getUid() . '" selected>' . $user->getUname() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label class="control-label">Inhalt *</label>
                            <textarea class="form-control" name="content" rows="10"><?= $a->getAtext() ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary">Aktualisieren</button>
                    <a class="btn btn-default" href="javascript:history.back()">Abbruch</a>
                </div>
            </form>

        <?php
        } else {
        ?>
            <div class="row">
                <h3>Beiträge können nur vom Verfasser bearbeitet werden!</h3>
            </div>
            <div class="row">
                <a href="javascript:history.back()" class="btn btn-danger" role="button"><span>Zurück</span></a>
            </div>
        <?php
        }
        ?>
    </div> <!-- /container -->
</body>

</html>