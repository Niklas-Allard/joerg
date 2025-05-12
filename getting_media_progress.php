<?php
// This script receives JSON data and saves it to a file named media_progress.json

// Get the raw POST data
$rawData = file_get_contents("php://input");

if ($rawData) {
    // Decode the JSON data
    $receivedData = json_decode($rawData, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        // Get the current data from the file if it exists
        $filePath = 'media_progress.json';
        $currentData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];

        // Merge the new data with the existing data
        $newData = array_merge($currentData, $receivedData);

        // Save the merged data back to the file
        file_put_contents($filePath, json_encode($newData, JSON_PRETTY_PRINT));

        // Respond with success
        echo json_encode(["status" => "success", "message" => "Data saved successfully."]);
    } else {
        // Respond with an error if JSON decoding fails
        echo json_encode(["status" => "error", "message" => "Invalid JSON data."]);
    }
} else {
    // Respond with an error if no data is received
    echo json_encode(["status" => "error", "message" => "No data received."]);
}
?>
