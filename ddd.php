<?php

function write_file($content) {

    $file = './tts/communication.txt'; // Die zu schreibende Datei

    // Datei im Schreibmodus öffnen (überschreibt die Datei)
    $handle = fopen($file, 'w');
    if ($handle) {
        fwrite($handle, $content); // Inhalt in die Datei schreiben
        fclose($handle); // Datei schließen
    } else {
        echo "Fehler beim Öffnen der Datei.";
    }
}
// Den empfangenen String lesen
$receivedString = file_get_contents("php://input");

write_file($receivedString);

// Python-Skript ausführen
exec('C:\Python\Python3123\python.exe C:\xampp\htdocs\joerg\tts\tts.py', $output, $status);

// Ausgabe des Python-Skripts anzeigen
foreach ($output as $line) {
    echo $line . "<br>";
}

// Überprüfen, ob das Skript erfolgreich abgeschlossen wurde (Exit-Code)
if ($status !== 0) {
    echo "Es gab einen Fehler bei der Ausführung des Python-Skripts. Exit-Status: $status";
}
?>