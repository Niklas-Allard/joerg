<?php
function get_next_file($path) {
    // Überprüfen, ob der gegebene Pfad ein Verzeichnis ist
    if (is_dir($path)) {
        return false;
    }

    $directory = str_replace(basename($path), "", $path);

    // Dateien und Ordner im Verzeichnis auslesen
    $items = scandir($directory);

    echo $items;
    echo $directory;

    // Nur Dateien filtern und alphabetisch sortieren
    $files = array_values(array_filter($items, function($item) use ($path) {
        return is_file($path . DIRECTORY_SEPARATOR . $item);
    }));

    sort($files);

    // Aktuelle Datei auslesen
    require "transforming_user_data.php";
    $user_data = loading_user_data("user_data.json");
    $current_file = $user_data["current_file"];

    // Index der aktuellen Datei finden
    $current_index = array_search(basename($current_file), $files);

    $message = ""; // the message to be returned

    // Nächste Datei bestimmen
    if ($current_index !== false && isset($files[$current_index + 1])) {
        $user_data["current_file"] = $files[$current_index + 1];
        saving_user_data("user_data.json", $user_data);
        $message = $files[$current_index + 1];
    } else {
        $message = "no next file";
    }
    
    return $message;
}

$path = "H:\\Hoerspiele\\5 Freunde\\001 - ... beim Wanderzirkus\\001 - ... Wanderzirkus.mp4";

$output = "";

$is_slash = false; // true if the for loop noticed a "/"

echo strlen($path);

for ($x = strlen($path) - 1; $x != strlen($path); $x--) {
    echo $x;
    echo $path[$x];
    echo $is_slash;
    echo $output;
    if ($path[$x] == "/") {
        $is_slash = true;
    };
    if ($is_slash) {
        $output = $path[$x] . $output;
    };
}

$path = $output;

echo $path;

$directory = str_replace(basename($path), "", $path);

echo $directory;