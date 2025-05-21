function get_next_file($path) {
    // Überprüfen, ob der gegebene Pfad ein Verzeichnis ist
    if (!is_dir($path)) {
        return false;
    }

    // Dateien und Ordner im Verzeichnis auslesen
    $items = scandir($path);

    // Nur Dateien filtern und alphabetisch sortieren
    $files = array_filter($items, function($item) use ($path) {
        return is_file($path . DIRECTORY_SEPARATOR . $item);
    });

    // Aktuelle Datei auslesen
    $user_data = loading_user_data("user_data.json");
    $current_file = $user_data["current_file"];

    // Index der aktuellen Datei finden
    $current_index = array_search(basename($currentFile), $files);

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