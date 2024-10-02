<?php

$stations = $model['stations'];
$model = $model['model'];

?>

<div class="container">
    <div class="row">
        <h2>Messwert bearbeiten</h2>
    </div>

    <form class="form-horizontal" action="index.php?r=measurement/update&id=<?= $model->getId() ?>" method="post">

        <div class="row">
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('time') ? 'has-error' : ''; ?>">
                    <label class="control-label">Zeitpunkt *</label>
                    <input type="text" class="form-control" name="time" value="<?= $model->getTime() ?>" placeholder="dd.mm.yyyy hh:mm:ss">

                    <?php if (!empty($model->errors['time'])): ?>
                        <div class="help-block"><?= $model->getError('time') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('temperature') ? 'has-error' : ''; ?>">
                    <label class="control-label">Temperatur [°C] *</label>
                    <input type="text" class="form-control" name="temperature" value="<?= $model->getTemperature() ?>">

                    <?php if (!empty($model->errors['temperature'])): ?>
                        <div class="help-block"><?= $model->getError('temperature') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="form-group required <?= $model->hasError('rain') ? 'has-error' : ''; ?>">
                    <label class="control-label">Regenmenge [ml] *</label>
                    <input type="text" class="form-control" name="rain" value="<?= $model->getRain() ?>">

                    <?php if (!empty($model->errors['rain'])): ?>
                        <div class="help-block"><?= $model->getError('rain') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group required <?= $model->hasError('station_id') ? 'has-error' : ''; ?>">
                    <label class="control-label">Station *</label>
                    <select class="form-control" name="station_id" style="width: 200px">
                        <?php
                        foreach($stations as $station):
                            echo '<option ' . ($model->getStationId() == $station->getId() ? 'selected=selected' : '') . ' value="' . $station->getId() . '">' . $station->getName() . '</option>';
                        endforeach;
                        ?>
                    </select>
                    <?php if (!empty($model->errors['rain'])): ?>
                        <div class="help-block"><?= $model->getError('station_id') ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Aktualisieren</button>
            <a class="btn btn-default" href="index.php?r=measurement/view&id=<?= $model->getId() ?>">Abbruch</a>
        </div>
    </form>

</div> <!-- /container -->
