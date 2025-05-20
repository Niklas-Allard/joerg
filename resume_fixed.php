<?php
function resume($directory = null) {
    // Wenn kein Verzeichnis übergeben wurde, nutze das aktuelle aus user_data
    if ($directory === null) {
        $user_data = loading_user_data("user_data.json");
        $directory = $user_data["current_file"];
    }
    
    // Überprüfe, ob das Verzeichnis existiert
    if (empty($directory)) {
        echo "<script>console.error('Kein gültiges Verzeichnis gefunden');</script>";
        return;
    }

    $seperated_path = explode("/", $directory);
    $allowed_file_types = loading_user_data("allowed_file_types.json");
    $last_watched_file = loading_user_data("last_watched_file.json");
    
    $category_or_directory = "category";
    
    // Die Dateiendung ist immer der letzte Teil nach der Aufspaltung
    $file_name = isset($seperated_path[count($seperated_path) - 1]) ? $seperated_path[count($seperated_path) - 1] : '';
    
    // Prüfe, ob es sich um eine Datei handelt
    foreach ($allowed_file_types as $file_type) {
        foreach ($file_type as $extension) {
            if (str_contains($file_name, $extension)) {
                $category_or_directory = "directory";
                break 2;
            }
        }
    }
    
    // Kategorie oder Verzeichnis ermitteln und weiterleiten
    if ($category_or_directory == "category") {
        // Bei einer Kategorie nehmen wir das übergeordnete Verzeichnis
        $url = basename(dirname($directory));
    } else {
        // Bei einer Datei nehmen wir den Hauptbereich (z.B. 'filme', 'serien')
        $url = isset($seperated_path[1]) ? $seperated_path[1] : '';
    }
    
    // Prüfe, ob die URL im last_watched_file existiert
    if (!empty($url) && isset($last_watched_file[$url])) {
        echo '
        <script>
            window.location.href = "' . $last_watched_file[$url] . '";
        </script>
        ';
        exit;
    } else {
        echo "<script>console.error('Kein letztes Video für " . addslashes($url) . " gefunden');</script>";
    }
}
?>
