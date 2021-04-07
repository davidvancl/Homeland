/*
 Name:    _monitoring.ino
 Created: 3/17/2021 11:12:48 AM
 Author:  David Vancl
*/
#include "DHT.h"

#define DHT_PIN_INSIDE   2 
#define DHT_PIN_OUTSIDE  3 
#define DHT_TYPE         DHT22
#define SERIAL_SPEED     9600
#define DATABASE         "Mongo"
#define RSA_KEY          "test"

byte getCO2cmd[] = { 0xFF, 0x01, 0x86, 0x00, 0x00, 0x00, 0x00, 0x00, 0x79 };
char co2_value_inside[9];
char co2_value_outside[9];

DHT dht_inside_sensor(DHT_PIN_INSIDE, DHT_TYPE);
DHT dht_outside_sensor(DHT_PIN_OUTSIDE, DHT_TYPE);

String serial_string;
unsigned long send_millis;

void setup() {
  Serial.begin(SERIAL_SPEED);
  Serial1.begin(SERIAL_SPEED);
  Serial2.begin(SERIAL_SPEED);
  Serial3.begin(SERIAL_SPEED);
  dht_inside_sensor.begin();
  dht_outside_sensor.begin();
  send_millis = millis();
}

void loop() {
  if (millis() - send_millis >= 30000) {
    
    float inside_humidity = dht_inside_sensor.readHumidity();
    float inside_temperature = dht_inside_sensor.readTemperature();
    
    float outside_humidity = dht_outside_sensor.readHumidity();
    float outside_temperature = dht_outside_sensor.readTemperature();

    Serial2.write(getCO2cmd, 9);
    Serial2.readBytes(co2_value_inside, 9);
    int inside_high = (int) co2_value_inside[2];
    int inside_low  = (int) co2_value_inside[3];
    int inside_pulse = (256 * inside_high) + inside_low;
    String inside_co2 = String(inside_pulse);

    Serial1.write(getCO2cmd, 9);
    Serial1.readBytes(co2_value_outside, 9);
    int outside_high = (int) co2_value_outside[2];
    int outside_low  = (int) co2_value_outside[3];
    int outside_pulse = (256 * outside_high) + outside_low;
    String outside_co2 = String(outside_pulse);
    
    String date_time = "2021-03-29 12:47:43";
    if (isnan(inside_humidity) || isnan(inside_temperature) || isnan(outside_humidity) || isnan(outside_temperature)) {
      return String("\"error_code\":\"404\"");
    }
  
    Serial3.print(F("{device_id=arduino_station"));
    Serial3.print(F("&temperature_inside="));
    Serial3.print(String(inside_temperature));
    Serial3.print(F("&temperature_outside="));
    Serial3.print(String(outside_temperature));
    Serial3.print(F("&humidity_inside="));
    Serial3.print(String(inside_humidity));
    Serial3.print(F("&humidity_outside="));
    Serial3.print(String(outside_humidity));
    Serial3.print(F("&co2_inside="));
    Serial3.print(String(inside_co2));
    Serial3.print(F("&co2_outside="));
    Serial3.print(String(outside_co2));
    Serial3.print(F("&date_time="));
    Serial3.print(String(date_time));
    Serial3.print(F("&db_type="));
    Serial3.print(String(DATABASE));
    Serial3.print(F("&rsa_key="));
    Serial3.print(String(RSA_KEY));
    Serial3.print(F("}"));

    send_millis = millis();
  }
}

void serialEvent3() {
  while (Serial3.available()) {
    char serial_char = Serial3.read();
    serial_string += serial_char;
    if (serial_char == '}') {
      Serial.println(serial_string);
      serial_string = "";
    }
  }
}