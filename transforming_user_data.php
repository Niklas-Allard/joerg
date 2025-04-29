<?php

function loading_user_data($path) {

    // loading the json file
    $jsonData = file_get_contents($path);

    // decoding the json file
    $data = json_decode($jsonData, true); 
    
    return $data;
};

function saving_user_data($item, $path) {
    
    $new_json_file = json_encode($item, JSON_PRETTY_PRINT);

    file_put_contents($path, $new_json_file);
}

?>