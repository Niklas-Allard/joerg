<?php
function get_next_file($path, $user_data) {
    // Überprüfen, ob der gegebene Pfad ein Verzeichnis ist
    if (is_dir($path)) {
        return false;
    }

    $output = "";

    $is_slash = false; // true if the for loop noticed a "/"

    for ($x = strlen($path) - 1; $x >= 0; $x--) {
        if ($path[$x] == "/" || $path[$x] == "\\") {
            $is_slash = true;
        };
        if ($is_slash) {
            $output = $path[$x] . $output;
        };
    }

    $directory = $output;

    // Dateien und Ordner im Verzeichnis auslesen
    $items = scandir($directory);

    // Entferne "." und ".."
    $items = array_filter($items, function($item) {
        return $item !== "." && $item !== "..";
    });

    // Nur Dateien filtern und alphabetisch sortieren
    $files = array_values(array_filter($items, function($item) use ($path, $directory) {
        return is_file($directory . DIRECTORY_SEPARATOR . $item);
    }));

    sort($files);

    // Index der aktuellen Datei finden
    $current_index = array_search(basename($path), $files);

    $message = "success"; // the message to be returned

    if ($current_index === false) {
        $message = "no current file";
        return $message;
    }

    // Nächste Datei bestimmen
    if ($current_index !== false && isset($files[$current_index + 1])) {
        $user_data["current_file"] = $directory . $files[$current_index + 1];

        saving_user_data($user_data, "user_data.json");
    } else {
        $message = "no next file";
    }
    
    return $message;
}