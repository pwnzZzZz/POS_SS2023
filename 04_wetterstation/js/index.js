document.addEventListener('DOMContentLoaded', function () {


    let buttonEl = document.getElementById('btnSearch');
    let selectEl = document.getElementById('dropdown');

    sendGETRequest(1);
    

    //andere und bessere Methode: buttonEl.addEventListener('click', function(){});

    buttonEl.onclick = function () {
        sendGETRequest(selectEl.value);
    }

    selectEl.onchange = function () {
        sendGETRequest(selectEl.value);
    }

    function sendGETRequest(data) {
        let ajax = new XMLHttpRequest();
        ajax.open('GET', 'localhost/05_Wetterstation/api/station/' + data + '/measurement', true);
        ajax.responseType = 'json';
        ajax.onload = function () {
            //console.log(ajax.response);
            loadChart(ajax.response);
            loadAllMeasurementsForStation(ajax.response);
        }
        ajax.send();
    }

    function loadChart(data) {

        let oldChart = Chart.getChart('chart');
        if(oldChart != undefined) {
            oldChart.destroy();
        }

        let zeitstempel = [];
        let temperaturdaten = [];
        let regen = [];

        //Durchlaufen einer Sammlung:
        data.forEach(element => {
            //console.log(element);
            zeitstempel.push(element.time);
            temperaturdaten.push(element.temperature);
            regen.push(element.rain);

        });

        var ctx = document.getElementById('chart');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: zeitstempel,
                datasets: [{
                    label: "Temperatur [°C]",
                    data: temperaturdaten,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgb(75, 192, 192)',
                    fill: false,
                    tension: 0
                },{
                    label: "Regenmenge (l)",
                    data: regen,
                    borderColor: 'rgb(75, 192, 255)',
                    backgroundColor: 'rgb(75, 192, 255)',
                    fill: false,
                    tension: 0
                }
            ]
            },

            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        type: 'linear',
                        position: 'left'
                    }]
                }
            }
        });
    }

    function parseMeasurementTable(data) {
        let tmp = "";


        data.forEach(element => {
            tmp += '<tr>';
            tmp += '<td>' + element.time + '</td>';
            tmp += '<td>' + element.temperature + '</td>';
            tmp += '<td>' + element.rain + '</td>';
            tmp += '<td>';
            tmp += '<a class="btn btn-info" href="index.php?r=measurement/view&id=' + element.id + '"><span class="glyphicon glyphicon-eye-open"></span></a>';
            tmp += '&nbsp;';
            tmp += '<a class="btn btn-primary" href="index.php?r=measurement/update&id=' + element.id + '"><span class="glyphicon glyphicon-pencil"></span></a>';
            tmp += '&nbsp;';
            tmp += '<a class="btn btn-danger" href="index.php?r=measurement/delete&id=' + element.id + '"><span class="glyphicon glyphicon-remove"></span></a>';
            tmp += '</td>';
            tmp += '</tr>';
        });

        return tmp;
    }

    function loadAllMeasurementsForStation(data) {
        var measurementTableHTML = parseMeasurementTable(data);

        document.getElementById('measurements').innerHTML = measurementTableHTML;
    }
    


})

