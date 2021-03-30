let temperatureChart, humidityChart, co2Chart;

function createStatChart(canvas, title_min, xTitle, yTitle) {
    return new Chart(document.getElementById(canvas).getContext('2d'), {
        data: {
            datasets: [{
                label: 'Vnitřní ' + title_min,
                backgroundColor: 'rgba(255, 99, 132, 1)',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: [],
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }, {
                label: 'Vnitřní ' + title_min,
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                data: [],
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }]
        },
        options: {
            animation: {
                duration: 0
            },
            scales: {
                xAxes: [{
                    type: 'time',
                    distribution: 'series',
                    offset: true,
                    ticks: {
                        major: {
                            enabled: true,
                            fontStyle: 'bold'
                        },
                        source: 'data',
                        autoSkip: true,
                        autoSkipPadding: 75,
                        maxRotation: 0,
                        sampleSize: 100
                    },
                    scaleLabel: {
                        display: true,
                        labelString: xTitle
                    }
                }],
                yAxes: [{
                    gridLines: {
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: yTitle
                    }
                }]
            }
        }
    });
}

function preloadPage() {
    temperatureChart = createStatChart("temperatureChart", "teplota", "Časová osa", "Stupně Celsia (°C)");
    humidityChart = createStatChart("humidityChart", "vlhkost", "Časová osa", "miligramů na litr (mg/L asi)");
    co2Chart = createStatChart("co2Chart", "CO2", "Časová osa", "parts per million (ppm)");

    let date = new Date();
    fillValues(document.getElementsByClassName("dateInputTo"), getDate(date));
    fillValues(document.getElementsByClassName("timeInputTo"), getTime(date));

    date.setDate(date.getDate() - 2);
    fillValues(document.getElementsByClassName("dateInputFrom"), getDate(date));
    fillValues(document.getElementsByClassName("timeInputFrom"), getTime(date));
}

function fillValues(elementArray, value) {
    Array.prototype.forEach.call(elementArray, function (element) {
        element.value = value;
    });
}

function chartVisibility(temperatureBool, humidityBool, co2Bool) {
    document.getElementById("temperatureContainer").hidden = !temperatureBool;
    document.getElementById("humidityContainer").hidden = !humidityBool;
    document.getElementById("co2Container").hidden = !co2Bool;
    if (temperatureBool && humidityBool && co2Bool) {
        temperatureBool = humidityBool = co2Bool = false;
    }
    document.getElementById("showTemperatureButton").disabled = temperatureBool;
    document.getElementById("showHumidityButton").disabled = humidityBool;
    document.getElementById("showCo2Button").disabled = co2Bool;
}

function getDate(date) {
    return date.getFullYear() + "-" +
        String(date.getMonth() + 1).padStart(2, '0') + "-" +
        String(date.getDate()).padStart(2, '0');
}

function getTime(date) {
    return String(date.getHours()).padStart(2, '0') + ":" + String(date.getMinutes()).padStart(2, '0');
}