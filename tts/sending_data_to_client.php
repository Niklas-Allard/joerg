<?php

// Funktionsdefinition
function send_to_client($file_path) {
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    echo ""; // Send data to client
    ob_flush();
    flush();
    sleep(1);
}

// Prüfen, ob ein Argument übergeben wurde
if ($argc > 1) {
    $file_path = $argv[1]; // Nimm das erste Argument nach dem Skriptnamen
    echo $file_path;
    echo send_to_client($file_path);
} else {
    echo "Bitte gib einen Namen als Argument an.";
}
?>