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
                label: 'Vnější ' + title_min,
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
                    time: {
                        parser: 'h:mm:ss a',
                        tooltipFormat: 'll HH:mm',
                        unit: 'day',
                        unitStepSize: 1,
                        displayFormats: {
                            'day': 'DD-MM-YYYY HH:mm'
                        }
                    },
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

function requestData(chart, type){
    let data = 'from=' + (
        document.getElementById(type + "_date_from").value + " " + document.getElementById(type + "_time_from").value + ":00"
    ) + "&to=" + (
        document.getElementById(type + "_date_to").value + " " + document.getElementById(type + "_time_to").value + ":00"
    ) + "&db=Mongo";
    let client = new XMLHttpRequest();
    client.open('POST', 'http://192.168.2.20/dave/mopa/download.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    client.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            chart.data.datasets[0].data = [];
            chart.data.datasets[1].data = [];
            chart.update();
            let responseData = JSON.parse(client.responseText);
            responseData['data'].forEach(function (record) {
                addData(chart, record['date'], record[type + 'Inside'],0)
                addData(chart, record['date'], record[type + 'Outside'],1)
            });
        } else {
            popupError("Odpověď ze sevrevu není správná. Kontaktujte admina.");
        }
    };
    client.onerror = function() {
        popupError("Error na straně klienta. Kontaktujte administrátora.");
    };
    client.send(data);
}

function addData(chart, time, value, dataSetIndex) {
    chart.data.datasets[dataSetIndex].data.push({
        t: moment(time, 'YYYY-MM-DD HH:mm:ss'),
        y: value
    });
    chart.update();
}

function popupError(message) {
    let box = document.getElementById("alert_box");
    box.innerHTML = message;
    box.hidden = false;
    setTimeout(function () {
        box.hidden = true;
    }, 5000);
}
