<div class="container">
    <div class="row">
        <h2>Awesome Wetterstation</h2>
    </div>
    <div class="row">
        <p class="form-inline">
            <select class="form-control" id="station" name="station_id" style="width: 200px">
                <?php
                foreach($model as $station):
                    echo '<option value="' . $station->getId() . '">' . $station->getName() . '</option>';
                endforeach;
                ?>
            </select>
            <button id="btnSearch" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Messwerte anzeigen</button>
            <a class="btn btn-default" href="index.php?r=station/index"><span class="glyphicon glyphicon-pencil"></span> Messstationen bearbeiten</a>

            <canvas id="chart" width="400" height="100"></canvas>

        <br/>

        <div class="row">
            <div class="col-sm-6">
                <p id="avgTemp">Durchschnitts Temp</p>
            </div>
            <div class="col-sm-6">
                <p id="avgRain">Durchschnitts Rain</p>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Zeitpunkt</th>
                <th>Temperatur [C°]</th>
                <th>Regenmenge [ml]</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="measurements"></tbody>
        </table>
    </div>
</div> <!-- /container -->
