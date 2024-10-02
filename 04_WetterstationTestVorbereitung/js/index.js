document.addEventListener('DOMContentLoaded', function () {

    getCurrentWeatherData(1);

    var buttonEl = document.getElementById("btnSearch");
    var searchEl = document.getElementById("station");

    buttonEl.onclick = function() {
        getCurrentWeatherData(searchEl.value);
    }

    searchEl.onchange = function() {
        getCurrentWeatherData(searchEl.value);
    }

    function getCurrentWeatherData(station) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "localhost/05_Wetterstation/api/station/"+station+"/measurement", true);
        xhr.responseType = 'json';
        xhr.onload = function() {
            loadChart(xhr.response);
            getTableMeasurementData(xhr.response);
            getAvgMeasurement(xhr.response);
        }
        xhr.send();
    }

    function getAvgMeasurement(data) {
        var sumTemp = 0;
        var sumRain = 0;
        var counter = 0;

        for (const element of data) {
            sumTemp += element.temperature;
            sumRain += element.rain;
            ++counter;
        }

        document.getElementById("avgTemp").innerHTML = (sumTemp/counter).toFixed(2)+"°C";
        document.getElementById("avgRain").innerHTML = (sumRain/counter).toFixed(2)+"ml";
    }

    function loadChart(data) {

        var labelChart = [];
        var tempChart = [];
        var rainChart = [];

        for (const element of data) {
            labelChart.push(element.time);
            tempChart.push(element.temperature);
            rainChart.push(element.rain);
        }


        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: labelChart,
                datasets: [{
                    label: "Temperatur [°C]",
                    data: tempChart,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgb(75, 192, 192)',
                    fill: false,
                    tension: 0
                }, {
                    label: "Rain [ml]",
                    data: rainChart,
                    borderColor: 'rgb(150, 192, 192)',
                    backgroundColor: 'rgb(150, 192, 192)',
                    fill: false,
                    tension: 0
                }]
            },

            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        type: 'linear',
                        position: 'left',
                        ticks: {
                            beginAtZero: true,
                            max: 25
                        }
                    }]
                }
            }
        });
    }

    function getTableMeasurementData(data) {
        var measurements = currentTableMeasurementData(data);
        document.getElementById("measurements").innerHTML = measurements;
    }

    function currentTableMeasurementData(data) {
        var tmp = "";

        for (const element of data) {
            tmp += "<tr>";
            tmp += "<td>"+element.time+"</td>";
            tmp += "<td>"+element.temperature+"</td>";
            tmp += "<td>"+element.rain+"</td>";
            tmp += '<td>';
            tmp += '<a class="btn btn-info" href="index.php?r=measurement/view&id=' + element.id + '"><span class="glyphicon glyphicon-eye-open"></span></a>';
            tmp += '&nbsp;';
            tmp += '<a class="btn btn-primary" href="index.php?r=measurement/update&id=' + element.id + '"><span class="glyphicon glyphicon-pencil"></span></a>';
            tmp += '&nbsp;';
            tmp += '<a class="btn btn-danger" href="index.php?r=measurement/delete&id=' + element.id + '"><span class="glyphicon glyphicon-remove"></span></a>';
            tmp += '</td>';
            tmp += "</tr>";
        }

        return tmp;
    }
})