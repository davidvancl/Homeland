let socket, temperatureGraph, humidityGraph, co2Graph, is_connection_paused;

function getFahrenheit(celsius) {
    return Math.round((celsius * (9 / 5) + 32) * 100) / 100;
}

function createGraph(containerID, titlePart) {
    return new Chart(document.getElementById(containerID).getContext('2d'), {
        type: 'line',
        options: {
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
                    scaleLabel: {
                        display: true,
                        labelString: "Čas"
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        },
        data: {
            datasets: [{
                label: 'Vnitřní ' + titlePart,
                data: [],
                backgroundColor: 'rgba(255, 99, 132, 1)',
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false,
                borderWidth: 2
            }, {
                label: 'Vnější ' + titlePart,
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 1)',
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: false,
                borderWidth: 2
            }]
        }
    });
}

function closeConnection() {
    socket.close();
    socket = null;
    document.getElementById("open_connection").disabled = false;
    document.getElementById("close_connection").disabled = true;
    document.getElementById("pause_connection").disabled = true;
    document.getElementById("pause_connection").innerHTML = "Pozastavit";
}

function changePause() {
    is_connection_paused = !is_connection_paused;
    let element = document.getElementById("connection_status");
    let elementButton = document.getElementById("pause_connection");
    if (is_connection_paused) {
        element.style.color = "yellow";
        element.innerHTML = "Pozastaveno";
        elementButton.innerHTML = "Pokračovat";
    } else {
        element.style.color = "green";
        element.innerHTML = "Připojeno";
        elementButton.innerHTML = "Pozastavit";
    }
}

function openConnection() {
    socket = new WebSocket("ws://192.168.2.20:9998");

    socket.addEventListener('open', function (event) {
        let element = document.getElementById("connection_status");
        element.style.color = "green";
        element.innerHTML = "Připojeno";

        temperatureGraph = createGraph('temperatureChart', 'teplota');
        humidityGraph = createGraph('humidityChart', 'vlhkost');
        co2Graph = createGraph('co2Chart', 'oxid uhličitý');

        let dw_buttons = document.getElementsByClassName("download_button");
        for (let i = 0; i < dw_buttons.length; i++) {
            dw_buttons[i].disabled = false;
        }
    });

    socket.addEventListener('close', (event) => {
        let element = document.getElementById("connection_status");
        element.style.color = "orangered";
        element.innerHTML = "Odpojeno";
    });

    socket.addEventListener('message', function (message) {
        if (!is_connection_paused) {
            let data_object = JSON.parse(message.data);
            document.getElementById("inside_temperature").innerHTML = data_object["temperature_inside"] + "°C / " + getFahrenheit(data_object["temperature_inside"]) + "°F";
            document.getElementById("outside_temperature").innerHTML = data_object["temperature_outside"] + "°C / " + getFahrenheit(data_object["temperature_outside"]) + "°F";
            document.getElementById("inside_humidity").innerHTML = data_object["humidity_inside"] + "% RH";
            document.getElementById("outside_humidity").innerHTML = data_object["humidity_outside"] + "% RH";
            document.getElementById("inside_co2").innerHTML = data_object["co2_inside"] + "ppm";
            document.getElementById("outside_co2").innerHTML = data_object["co2_outside"] + "ppm";
            document.getElementById("last_monitoring").innerHTML = "Poslední změna: <b>" + data_object["date_time"] + "</b>";
            addData(temperatureGraph, data_object["date_time"], data_object["temperature_inside"], 0);
            addData(temperatureGraph, data_object["date_time"], data_object["temperature_outside"], 1);
            addData(humidityGraph, data_object["date_time"], data_object["humidity_inside"], 0);
            addData(humidityGraph, data_object["date_time"], data_object["humidity_outside"], 1);
            addData(co2Graph, data_object["date_time"], data_object["co2_inside"], 0);
            addData(co2Graph, data_object["date_time"], data_object["co2_outside"], 1);
        }
    });
    document.getElementById("open_connection").disabled = true;
    document.getElementById("close_connection").disabled = false;
    document.getElementById("pause_connection").disabled = false;
    is_connection_paused = false;
}