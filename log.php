<?php

class Log {

    public function loading_log() {
        $data = file_get_contents('log.json'); // loads Array-Data
        $jsonArray = json_decode($data, true); // decoding the array-data

        return $jsonArray;
    }

    public function saving_log($user_input) {

        $data = $this->loading_log();

        $log = date("d-m-Y H:i:s") . " : " . $user_input;

        $array_user_input = [$log];

        $final_data = array_merge($data, $array_user_input);

        $jsonData = json_encode($final_data); // encodes the array

        file_put_contents('log.json', $jsonData); // saves the json data
    }

    public function deleting_all_logs() {

        $array = [];

        $jsonData = json_encode($array); // encodes the array

        file_put_contents('log.json', $jsonData); // saves the json data
    }

    public function delete_log($user_input) {

        $data = $this->loading_log();

        $filtered_array = array_filter($data, function($value, $user_input) {
            return $value !== $user_input;
        });

        $filtered_array = array_values($filtered_array);

        $jsonData = json_encode($filtered_array); // encodes the array

        file_put_contents('log.json', $jsonData); // saves the json data
    }
}

?>