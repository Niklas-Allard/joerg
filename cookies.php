<?php
// Define the path to the communication.txt file
$file_path = './tts/cookies_message.txt';

// Check if the file exists
if (file_exists($file_path)) {
    // Read the file contents
    $file_content = file_get_contents($file_path);

    // Ausführen einer JavaScript-Datei auf dem Server
    $output = shell_exec('node meine_datei.js');
} else {
    echo "File not found.";
}
?>