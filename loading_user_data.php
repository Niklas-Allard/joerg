<?php

function loading_user_data($path) {

    // loading the json file
    $jsonData = file_get_contents($path);

    // decoding the json file
    $data = json_decode($jsonData, true); 
    
    return $data;
};

?>