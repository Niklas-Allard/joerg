<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo "PHP-Skript gestartet.<br>";

// Daten empfangen
$receivedString = file_get_contents("php://input");

if ($receivedString === false) {
    echo "Fehler beim Lesen der Eingabedaten.";
} elseif (empty($receivedString)) {
    echo "Keine Daten empfangen.";
} else {
    echo "Empfangene Daten: " . $receivedString . "<br>";
}

// Datei schreiben
$file = __DIR__ . '/tts/communication.txt';
if (file_put_contents($file, $receivedString) === false) {
    echo "Fehler beim Schreiben der Datei.";
} else {
    echo "Daten erfolgreich in die Datei geschrieben.<br>";
}

require "transforming_user_data.php";
$user_data = loading_user_data("user_data.json");

// Python-Skript ausführen
exec($user_data["python_path"] . ' C:\xampp\htdocs\joerg\tts\tts.py 2>&1', $output, $status);

require "log.php";

$log->saving_log($output);

if ($status !== 0) {
    echo "Fehler beim Ausführen des Python-Skripts. Status: $status";
} else {
    echo "Python-Skript erfolgreich ausgeführt.";
}
?>