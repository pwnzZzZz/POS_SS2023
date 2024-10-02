document.addEventListener('DOMContentLoaded', function(){

    let long = 10.7455712;
    let lat = 47.2242934;

    function getCurrentWeatherData()
    {
        let xhr = new XMLHttpRequest();
        //xhr.open("GET", "https://api.openweathermap.org/data/2.5/weather?lat="+lat+"&lon="+long+"&units=metric&lang=de&appid=b88cf7da00c9e0f4a278230e3f035980", true);
        // xhr.responseType = 'json';
        // xhr.onload = function()
        // {
        //     let data = xhr.response;
        //     //console.log(data);
        //     //return data;
        //     showCurrentTemp(data);
        // }
        //xhr.send();
    }


    function getForecastWeatherData()
    {
        // let xhr = new XMLHttpRequest();
        // xhr.open("GET", "https://api.openweathermap.org/data/2.5/forecast/daily?lat="+lat+"&lon="+long+"&cnt=7&units=metric&lang=de&appid=b88cf7da00c9e0f4a278230e3f035980", true);
        // xhr.responseType = 'json';
        // xhr.onload = function()
        // {
        //     let data = xhr.response;
        //     console.log(data);
        //     loadChart(data);
        // }
        // xhr.send();
    }


    loadChart();
    getCurrentWeatherData();
    getForecastWeatherData();

    function showCurrentTemp(data)
    {
        let temp = data.main.temp;
        let feelslike = data.main.feels_like;
        let tempEl = document.querySelector('#temp');
        let feelsLikeEl = document.querySelector('#feelslike');
        tempEl.textContent = temp+"°C";
        feelsLikeEl.textContent = feelslike+"°C";
    }
  
 
    function loadChart(data)
    {
        //   let city = data.city.name;
        //   let datalist = data.list;
        //   console.log(new Date(data.list[0].dt*1000));
          
        //   let labelList = [];
        //   let valueList = [];
        //   for (const element of datalist) {
        //         labelList.push(new Date(element.dt*1000).toLocaleDateString());
        //         valueList.push(element.temp.day);
        //   }

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
                data: [18,22,15,19, 21, 22, 20],
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



});