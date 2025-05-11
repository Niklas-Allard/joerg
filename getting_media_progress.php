<?php
// This script receives GET data and saves it to a file named media_progress.json

// Check if GET parameters are set
if (!empty($_GET)) {
    // Get the current data from the file if it exists
    $filePath = 'media_progress.json';
    $currentData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];

    $key = array_key_first($_GET);


    // Merge the new data with the existing data
    $newData = array_merge($currentData, $_GET);

    // Save the merged data back to the file
    file_put_contents($filePath, json_encode($newData, JSON_PRETTY_PRINT));

    // Respond with success
    //echo json_encode(["status" => "success", "message" => "Data saved successfully."]);
    echo json_encode($key);
} else {
    // Respond with an error if no GET data is provided
    echo json_encode(["status" => "error", "message" => "No data received."]);
}
?>
