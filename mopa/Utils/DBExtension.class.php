<?php
class DBExtension {
    protected function get_db_json_response($response){
        $jsonObject = [
            'data' => []
        ];

        foreach ($response as $record){
            $jsonObject['data'][] = [
                'date' => $record['date_time'],
                'temperatureInside' => $record['temperature_inside'],
                'temperatureOutside' => $record['temperature_outside'],
                'humidityInside' => $record['humidity_inside'],
                'humidityOutside' => $record['humidity_outside'],
                'co2Inside' => $record['co2_inside'],
                'co2Outside' => $record['co2_outside']
            ];
        }

        return json_encode($jsonObject);
    }
}