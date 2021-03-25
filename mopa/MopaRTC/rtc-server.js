#!/usr/bin/env node

let net_host = "192.168.2.20";
let net_port = 9999;
let ws_port = 9998;
let ws_host = net_host;
let clientList = [];
let printMode = false;

const GUI = new (require("./Utils/ConsoleWriter.js"))();
const webSocketServer = new (require('ws')).Server({port: ws_port});
const netServer = (require('net')).createServer();

function sendToAll (message) {
    for (let i = 0; i < clientList.length; i++) {
        if (clientList[i].readyState === 3){
            clientList.splice(i,1);
        } else {
            clientList[i].send(message);
        }
    }
}

class RTCServer {
    constructor() {
        if (printMode) GUI.printMessage("Starting WebSocketServer => ws://" + ws_host + ":" + ws_port);
        if (printMode) GUI.printMessage("Starting NetServer => inet://" + net_host + ":" + net_host);
        this.registerServerListeners();
        netServer.listen(net_port, net_host);
    }

    registerServerListeners() {
        webSocketServer.on('connection', function connection(client){
            if (printMode) GUI.printMessage("Client connected and add to list.");
            clientList.push(client);
        });

        netServer.on('connection', function (netClient){
            netClient.on('data', function (buffer) {
                sendToAll(buffer.toString('utf8'));
            })
        });
    }
}
new RTCServer();