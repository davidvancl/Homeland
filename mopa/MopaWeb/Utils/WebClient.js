const socket = new WebSocket("ws://192.168.2.20:9998");

function getFahrenheit(celsius) {
    return Math.round((celsius * (9/5) + 32) * 100) / 100;
}

socket.addEventListener('open', function (event) {
    let element = document.getElementById("connection_status");
    element.style.color = "green";
    element.innerHTML = "Připojeno";
});

socket.addEventListener('close', (event) => {
    let element = document.getElementById("connection_status");
    element.style.color = "orangered";
    element.innerHTML = "Odpojeno";
});

socket.addEventListener('message', function (message) {
    let data_object = JSON.parse(message.data);
    document.getElementById("inside_temperature").innerHTML = data_object["temperature_inside"] + "°C / " + getFahrenheit(data_object["temperature_inside"]) + "°F";
    document.getElementById("outside_temperature").innerHTML = data_object["temperature_outside"] + "°C / " + getFahrenheit(data_object["temperature_outside"]) + "°F";
    document.getElementById("inside_humidity").innerHTML = data_object["humidity_inside"] + "°C / " + getFahrenheit(data_object["humidity_inside"]) + "°F";
    document.getElementById("outside_humidity").innerHTML = data_object["humidity_outside"] + "°C / " + getFahrenheit(data_object["humidity_outside"]) + "°F";
    document.getElementById("last_monitoring").innerHTML = "Poslední změna: <b>" + data_object["date_time"] + "</b>";
});