#!/usr/bin/env node
host_s = "192.168.2.20";
port_s = 9999;

const GUI = new (require("./Utils/ConsoleWriter.js"))();
const webSocketServer = new (require('ws')).Server({port: 9998});
const netServer = require('net').createServer();

let clientList = [];

class RTCServer {

    constructor() {
        GUI.printMessage("Starting server ws://localhost:9998");
        this.registerServerListeners();
        netServer.listen(port_s, host_s);
    }

    registerServerListeners() {
        webSocketServer.on('connection', function connection(client){
            GUI.printMessage("Client connected.");
            clientList.push(client);
        });

        netServer.on('listening', function () {

        });

        netServer.on('connection', function (socket){
            socket.on('data', function (buf) {
                sendAll(buf.toString('utf8'));
            })
        });
    }
}

function sendAll (message) {
    for (let i = 0; i < clientList.length; i++) {
        clientList[i].send("Message: " + message);
    }
}

new RTCServer();