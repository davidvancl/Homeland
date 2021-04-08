/*
 Name:    _monitoring.ino
 Created: 3/17/2021 11:12:48 AM
 Author:  David Vancl
*/
#include "DHT.h"
#include "RTClib.h"

#define DHT_PIN_INSIDE   2 
#define DHT_PIN_OUTSIDE  3 
#define DHT_TYPE         DHT22
#define SERIAL_SPEED     9600
#define DATABASE         "Mongo"
#define RSA_KEY          "test"
#define MEASURE_DELAY    10000
#define CO2_DELAY        30000
#define LED_DELAY        500
#define RED_LED          8
#define GREEN_LED        9

byte getCO2cmd[] = { 0xFF, 0x01, 0x86, 0x00, 0x00, 0x00, 0x00, 0x00, 0x79 };
char co2_value_inside[9], co2_value_outside[9];

String serial_string, last_inside_co2, last_outside_co2;
unsigned long send_millis, co2_millis;

DHT dht_inside_sensor(DHT_PIN_INSIDE, DHT_TYPE);
DHT dht_outside_sensor(DHT_PIN_OUTSIDE, DHT_TYPE);
RTC_DS3231 rtc;

void setup() {
  pinMode(RED_LED, OUTPUT);
  pinMode(GREEN_LED, OUTPUT);
  Serial.begin(SERIAL_SPEED);
  Serial1.begin(SERIAL_SPEED);
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
  digitalWrite(RED_LED, HIGH);
  delay(180000);
  digitalWrite(RED_LED, LOW);
}

void loop() {
  if (millis() - send_millis >= MEASURE_DELAY) {
    float inside_humidity = dht_inside_sensor.readHumidity();
    float inside_temperature = dht_inside_sensor.readTemperature();
    float outside_humidity = dht_outside_sensor.readHumidity();
    float outside_temperature = dht_outside_sensor.readTemperature();
    String outside_co2 = "";
    String inside_co2 = "";
    
    if (millis() - co2_millis >= CO2_DELAY) {
      outside_co2 = getOutsideCO2();
      inside_co2 = getInsideCO2();
      last_inside_co2 = inside_co2;
      last_outside_co2 = outside_co2;
      co2_millis = millis();
    } else {
      outside_co2 = last_outside_co2;
      inside_co2 = last_inside_co2;
    }
   
    String date_time = getNow();
    
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

String getNow(){
  DateTime actual = rtc.now();
  char dateBuffer[12];
  char timeBuffer[12];
  sprintf(dateBuffer,"%04u-%02u-%02u ", actual.year(), actual.month(), actual.day());
  sprintf(timeBuffer,"%02u:%02u:%02u", actual.hour(), actual.minute(), actual.second());

  return String(dateBuffer) + "" + (timeBuffer);
}

String getOutsideCO2(){
    Serial1.write(getCO2cmd, 9);
    Serial1.readBytes(co2_value_outside, 9);
    int outside_high = (int) co2_value_outside[2];
    int outside_low  = (int) co2_value_outside[3];
    int outside_pulse = (256 * outside_high) + outside_low;
    return String(outside_pulse);
}

String getInsideCO2(){
    Serial2.write(getCO2cmd, 9);
    Serial2.readBytes(co2_value_inside, 9);
    int inside_high = (int) co2_value_inside[2];
    int inside_low  = (int) co2_value_inside[3];
    int inside_pulse = (256 * inside_high) + inside_low;
    return String(inside_pulse);
}

void serialEvent3() {
  while (Serial3.available()) {
    char serial_char = Serial3.read();
    serial_string += serial_char;
    if (serial_char == '}') {
      Serial.println(serial_string);
      if (serial_string == "{OK}"){
        
      } 
      serial_string = "";
    }
  }
}
