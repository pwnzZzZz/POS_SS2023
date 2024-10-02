<!DOCTYPE html>
<html lang="de">
<?php
include "../helper/head.php";
include "../../config.php";

require_once('../../models/Article.php');
require_once('../../models/User.php');

$currentUser = User::get($_SESSION['user']);

$a = new Article();

if(!empty($_POST)) {
    $a->setAtitle(isset($_POST['title']) ? $_POST['title'] : '');
    $a->setAtext(isset($_POST['text']) ? $_POST['text'] : '');
    $a->setAcreationdate(isset($_POST['date']) ? $_POST['date'] : '');
    $a->setUid($currentUser->getUid());

    if($a->save()) {
        header("Location: view.php?aid=" . $a->getAid());
        exit();
    }
}
?>

<body>

<?php
$pathToArticle = "index.php";
$pathToIndex = "../../index.php";
include "../helper/navbar.php";
?>

<div class="container">
    <div class="row">
        <h2>Beitrag erstellen</h2>
    </div>
    <?php
        var_dump($currentUser);
    ?>
    <form class="form-horizontal" action="create.php" method="post">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group required">
                    <label class="control-label" for="title">Titel *</label>
                    <input type="text" class="form-control" name="title" maxlength="45" value="<?= $a->getAtitle() ?>">
                    <?php if(!empty($a->getErrors()['atitle'])): ?>
                    <div class="help-block"><?= $a->getErrors()['atitle'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required">
                    <label class="control-label" for="date">Freigabedatum *</label>
                    <input type="date" class="form-control" name="date" value="<?= $a->getAcreationdate() ?>">
                    <?php if(!empty($a->getErrors()['acreationdate'])): ?>
                    <div class="help-block"><?= $a->getErrors()['acreationdate'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group required">
                    <label class="control-label" for="uid">Besitzer *</label>
                    <input type="text" class="form-control" name="uid" value="<?= $currentUser->getUname() ?>" readonly >
                    <?php if(!empty($a->getErrors()['uid'])): ?>
                    <div class="help-block"><?= $a->getErrors()['uid'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group required">
                    <label class="control-label" for="text">Inhalt *</label>
                    <textarea class="form-control" name="text" rows="10" value="<?= $a->getAtext() ?>"></textarea>
                    <?php if(!empty($a->getErrors()['atext'])): ?>
                    <div class="help-block"><?= $a->getErrors()['atext'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Erstellen</button>
            <a class="btn btn-default" href="javascript:history.back()">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
</body>
</html>