<?php
function shuffle_files($dir_name, $user_data) {

    $shuffle = loading_user_data("shuffle.json"); // stores the next possible shuffle file

    if (!isset($shuffle[$dir_name]) || count($shuffle[$dir_name]) == 0) {
        $all_files = scandir($dir_name);

        if ($all_files === false) {
            require "log.php";
            $log = new Log();
            $log->saving_log("Error: Unable to read directory: " . $dir_name);
        }

        $allowed_files_types = loading_user_data("allowed_file_types.json");

        $new_shuffle = array();

        foreach ($all_files as $file) {
            foreach ($allowed_files_types["movie"] as $type) {
                if (str_ends_with($file, $type)) {
                    $new_shuffle[] = $file;
                }
            }
            foreach ($allowed_files_types["audio"] as $type) {
                if (str_ends_with($file, $type)) {
                    $new_shuffle[] = $file;
                } 
            }
        }
        
        $shuffle[$dir_name] = $new_shuffle;

        saving_user_data($shuffle, "shuffle.json");

        $user_data["current_file"] = array_rand($shuffle[$dir_name]);
        saving_user_data($user_data, "user_data.json");
    } else {
        $random_file_name = array_rand($shuffle[$dir_name]);

        $user_data["current_file"] = $user_data["current_directory"] . "\/" . $shuffle[$dir_name][$random_file_name];
        saving_user_data($user_data, "user_data.json");

        // Entferne die Datei aus dem Shuffle-Array
        if (isset($shuffle[$dir_name][$random_file_name])) {
            unset($shuffle[$dir_name][$random_file_name]); // Lösche das Element
        }

        saving_user_data($shuffle, "shuffle.json");

        echo $user_data["current_file"];
    }
}