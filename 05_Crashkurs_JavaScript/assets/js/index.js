//Handler wird ausgeführt, sobald DOM vollständig geladen wurde.
document.addEventListener('DOMContentLoaded', function(){

    //Koordinaten von Imst
    //Verbesserung: Hole Koordinaten von der Geolocation-API
    let long = 10.7455712;
    let lat = 47.2242934;
    let city = "Imst";

    //console.log("Test");

    getCurrentTemp(city);

    function getCurrentTemp(suchwort){
      let xhr = new XMLHttpRequest();


      xhr.open("GET", "https://api.openweathermap.org/data/2.5/weather?q="+ suchwort + ",AT&units=metric&lang=de&appid=438d8ffc653090da821b096fff502036", true);
      xhr.responseType = "json";
      xhr.onload = function(){
        let data = xhr.response;
        fillCurrentTemp(data);
        fillFeelsLike(data);
        fillHumidity(data);
        //console.log(data);
      }
      xhr.send();
    }


    

    function getForecastTemp(suchwort){
      let xhr = new XMLHttpRequest();

      xhr.open("GET", "https://api.openweathermap.org/data/2.5/forecast?q="+ suchwort +",AT&units=metric&lang=de&appid=438d8ffc653090da821b096fff502036", true);
      xhr.responseType = "json";
      xhr.onload = function(){
        let data = xhr.response;
        //console.log(xhr.response);
        loadChart(data);
        fillTable(data);
      }
      xhr.send();
    }

    

    function fillCurrentTemp(data){
      let tempEl = document.getElementById("temp");
      tempEl.textContent = data.main.temp + "°C";
    }

    function fillFeelsLike(data){
      let feelsEl = document.getElementById("feelsLike");
      feelsEl.textContent = data.main.feels_like + "°C";
    }

    function fillHumidity(data){
      let humidEl = document.getElementById("humidity");
      humidEl.textContent = data.main.humidity +"%";
    }

    let buttonEl = document.getElementById("searchButton");
    buttonEl.onclick = function(){
      let inputEl = document.getElementById("searchCity");
      //console.log(inputEl);
      let suchwort = inputEl.value; 
      getCurrentTemp(suchwort);
      getForecastTemp(suchwort);
    }
  


     //loadChart([]);

    function loadChart(data)
    {

          let dataList = data.list;

          let temps = [];

          for (const element of dataList) {
            temps.push(element.main.temp);
          }

          console.log(temps);

          //Wenn bereits ein Chart existiert, wird dieses gelöscht.
          let oldChart = Chart.getChart("#lineChart");
          if (oldChart != undefined)
          {
                oldChart.destroy();
          }
          
          new Chart(document.querySelector('#lineChart'), {
            type: 'line',
            data: {
              labels: ["heute", "morgen", "übermorgen","+3", "+4", "+5", "+6"],
              datasets: [{
                label: 'Temp. der nächsten 7 Tage',
                data: temps,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
    }

    function fillTable(data){
      let string = "";

      for (const element of data.list) {
        string +=                "<tr>"
        string +=                "<th scope='row'>"+ element.dt_txt +"</th>"
        string +=                "<td>"+ element.main.feels_like +"</td>"
        string +=                "<td>"+ element.main.temp +"</td>"
        string +=                "<td>"+ element.main.temp_min +"</td>"
        string +=                "<td>"+ element.main.temp_max +"</td>"
        string +=                "</tr>" 
      }

      let table = document.getElementById("tbody");

      table.innerHTML = string;
    }


});