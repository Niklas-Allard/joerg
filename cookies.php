<?php
// Define the path to the communication.txt file
$file_path = './tts/cookies_message.txt';

// Check if the file exists
if (file_exists($file_path)) {
    // Read the file contents
    $file_content = file_get_contents($file_path);

    // Set the cookie
    setcookie("audio_file_path", $file_content, time() + (86400 * 30), "C:/xampp/htdocs/joerg/"); // 86400 = 1 day
} else {
    echo "File not found.";
}
?>