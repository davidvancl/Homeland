/*
 Name:    _monitoring.ino
 Created: 3/17/2021 11:12:48 AM
 Author:  David Vancl
*/
#include "SPI.h"
#include "DHT.h"
#include "RTClib.h"
#include "SD.h"

#define DHT_PIN_INSIDE   2 
#define DHT_PIN_OUTSIDE  3 
#define DHT_TYPE         DHT22
#define SERIAL_SPEED     9600
#define DATABASE         "Mongo"
#define RSA_KEY          "test"
#define MEASURE_DELAY    10000
#define CO2_DELAY        30000
#define LED_DELAY        500
#define RED_LED          7
#define GREEN_LED        6

String serial_string;
int last_inside_co2, last_outside_co2;
unsigned long send_millis, co2_millis;
const int inside_pwmPin = 8;
const int outside_pwmPin = 9;

DHT dht_inside_sensor(DHT_PIN_INSIDE, DHT_TYPE);
DHT dht_outside_sensor(DHT_PIN_OUTSIDE, DHT_TYPE);
RTC_DS3231 rtc;

void setup() {
  pinMode(RED_LED, OUTPUT);
  pinMode(GREEN_LED, OUTPUT);
  pinMode(53, OUTPUT);
  pinMode(inside_pwmPin, INPUT_PULLUP);
  pinMode(outside_pwmPin, INPUT_PULLUP);
  Serial.begin(115200);
  Serial2.begin(SERIAL_SPEED);
  Serial3.begin(SERIAL_SPEED);
  dht_inside_sensor.begin();
  dht_outside_sensor.begin();
  send_millis = millis();
  co2_millis = millis();
  rtc.begin();
  if (rtc.lostPower()) {
    rtc.adjust(DateTime(F(__DATE__), F(__TIME__)));
  }

  if (SD.begin()) {
    Serial.println("SD card is ready to use.");
  } else {
    Serial.println("SD card initialization failed");
  }
  
  digitalWrite(RED_LED, HIGH);
  delay(180000);
  digitalWrite(RED_LED, LOW);
}
float inside_humidity;
float inside_temperature;
float outside_humidity;
float outside_temperature;
int outside_co2;
int inside_co2;
String date_time;

void loop() {
  if (millis() - send_millis >= MEASURE_DELAY) {
    inside_humidity = dht_inside_sensor.readHumidity();
    inside_temperature = dht_inside_sensor.readTemperature();
    outside_humidity = dht_outside_sensor.readHumidity();
    outside_temperature = dht_outside_sensor.readTemperature();
    outside_co2 = getCO2(outside_pwmPin);;
    inside_co2 = getCO2(inside_pwmPin);
    date_time = getNow();
    
    if (isnan(inside_humidity) || isnan(inside_temperature) || isnan(outside_humidity) || isnan(outside_temperature)) {
      return String("\"error_code\":\"404\"");
    }

    Serial3.print(F("{device_id=arduino_station"));
    Serial3.print(F("&temperature_inside="));
    Serial3.print(inside_temperature);
    Serial3.print(F("&temperature_outside="));
    Serial3.print(outside_temperature);
    Serial3.print(F("&humidity_inside="));
    Serial3.print(inside_humidity);
    Serial3.print(F("&humidity_outside="));
    Serial3.print(outside_humidity);
    Serial3.print(F("&co2_inside="));
    Serial3.print(inside_co2);
    Serial3.print(F("&co2_outside="));
    Serial3.print(outside_co2);
    Serial3.print(F("&date_time="));
    Serial3.print(date_time);
    Serial3.print(F("&db_type="));
    Serial3.print(DATABASE);
    Serial3.print(F("&rsa_key="));
    Serial3.print(RSA_KEY);
    Serial3.print(F("}"));

    send_millis = millis();
  }
}

String getNow(){
  DateTime actual = rtc.now();
  char dateBuffer[12];
  char timeBuffer[12];
  sprintf(dateBuffer,"%04u-%02u-%02u ", actual.year(), actual.month(), actual.day());
  sprintf(timeBuffer,"%02u:%02u:%02u", actual.hour(), actual.minute(), actual.second());
  return String(dateBuffer) + "" + (timeBuffer);
}

int getCO2(int pin){
  while (digitalRead(pin) == LOW) {};
  long t0 = millis();
  while (digitalRead(pin) == HIGH) {};
  long t1 = millis();
  while (digitalRead(pin) == LOW) {};
  long t2 = millis();
  long tH = t1-t0;
  long tL = t2-t1;
  long ppm = 5000L * (tH - 2) / (tH + tL - 4);
  while (digitalRead(pin) == HIGH) {};
  delay(10);
  return int(ppm);
}

void serialEvent3() {
  while (Serial3.available()) {
    char serial_char = Serial3.read();
    serial_string += serial_char;
    if (serial_char == '}') {
      Serial.println(serial_string);
      if (serial_string == "{WiFi Disconnected}"){
        File logFile = SD.open("log.txt", FILE_WRITE);
        if (logFile) {
          logFile.print(F("{device_id=arduino_station"));
          logFile.print(F("&temperature_inside="));
          logFile.print(inside_temperature);
          logFile.print(F("&temperature_outside="));
          logFile.print(outside_temperature);
          logFile.print(F("&humidity_inside="));
          logFile.print(inside_humidity);
          logFile.print(F("&humidity_outside="));
          logFile.print(outside_humidity);
          logFile.print(F("&co2_inside="));
          logFile.print(inside_co2);
          logFile.print(F("&co2_outside="));
          logFile.print(outside_co2);
          logFile.print(F("&date_time="));
          logFile.print(date_time);
          logFile.print(F("&db_type="));
          logFile.print(DATABASE);
          logFile.print(F("&rsa_key="));
          logFile.print(RSA_KEY);
          logFile.println(F("}"));
        }
        logFile.close();
        Serial.println("{SD save OK}");
      }
      serial_string = "";
    }
  }
}
