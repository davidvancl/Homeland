/*
 Name:    _ESP8266.ino
 Created: 3/17/2021 11:11:41 AM
 Author:  David Vancl
*/
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

#define SERIAL_SPEED 9600

const char* ssid = "Archer";
const char* password = "Qxhk[e@ZX4d$y3H";

String serverName = "http://192.168.2.20:80/dave/mopa/upload.php";
String serial_string = "";

void setup() {
  Serial.begin(SERIAL_SPEED);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.write("Connected.");
}

void loop() {
  while (Serial.available()) {
    char serial_char = Serial.read();
    serial_string += serial_char;
    if (serial_char == '}') {
      serial_string.remove(0, 1);
      serial_string.remove(serial_string.length() - 1, 1);
      if (WiFi.status() == WL_CONNECTED) {
        HTTPClient httpClient;
        httpClient.begin(serverName);
        httpClient.addHeader("Content-Type", "application/x-www-form-urlencoded");
        int httpCode = httpClient.POST(serial_string);
        String payload = httpClient.getString();
        Serial.print(payload);
      } else {
        WiFi.reconnect();
        Serial.println("{WiFi Disconnected}");
      }
      serial_string = "";
    }
  }
}
