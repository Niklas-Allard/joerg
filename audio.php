<?php

require "transforming_user_data.php";
require "log.php";

$user_data = loading_user_data("user_data.json");
$css = loading_user_data("css.json");

$navbar_width = $css["navbar_width"];
$navbar_color = $css["navbar_color"];
$icon_size = $css["icon_size"];
$cover_size = $css["cover_size"];
$main_container_color = $css["main_container_color"];
$content_color = $css["content_color"];


if (isset($_GET["category"])) {
  require "next_file.php";
  $output = get_next_file($user_data["current_file"], $user_data);

  echo "<script>let resume = 'none';</script>";

  if ($output === "no next file") {
    echo "
    <script>
      var response = new Audio('feedback/Keine naechste Datei.wav');
      response.play();

      resume = 'resume';
    </script>";
  } elseif ($output === "no current file") {
    if ($user_data["log"] === true) {
      $log = new Log();
      $log->saving_log("movie.php: no current file");
    }
  } else {
    // Weiterleitung zur nächsten Datei
    header("Location: audio.php");
  }

  if ($output !== "no next file" && $output !== "no current file") {
    $user_data = loading_user_data("user_data.json");

    $directory = $user_data["current_directory"];

    // saving the last watched file in a category or directory
    $last_watched_file = loading_user_data("last_watched_file.json");

    $current_file = $user_data["current_file"];
    
    // saving the last watched file in the directory
    $last_watched_file[$user_data["current_directory"]] = $user_data["current_file"]; 
                  
    // saving the last watched file in the category

    $seperated_path = explode("/", $directory);

    $key = "";

    for ($item_id = count($seperated_path) - 1; $item_id > 1; $item_id--) {
      for ($id = 0; $id < $item_id; $id++) {
        if ($id == $item_id - 1) {
          $key .= $seperated_path[$id];
        }
        else {
          $key .= $seperated_path[$id] . "/";
        }
      }
      $last_watched_file[$key] = $user_data["current_file"];

      echo $key;

      $key = "";
    }

    saving_user_data($last_watched_file, "last_watched_file.json");
  };
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout</title>
  <script src="no_context_menu.js"></script>
  <script src="send_data_media_progress.js"></script>
  <style>

body {
  margin: 0;
  font-family: Arial, sans-serif;
  display: flex;
  height: 100vh; /* Volle Höhe des Viewports */
}

.layout {
  display: flex;
  width: 100%;
}

.navbar {
  display: flex;
  flex-direction: column; /* Vertikale Anordnung der Navbar */
  width: <?php echo $navbar_width; ?>; /* Festlegen der Navbar-Breite */
  background-color: #2c3e50;
  color: white;
  padding: 20px;
  box-sizing: border-box;
  height: 100vh; /* Volle Höhe des Viewports */
}

.navbar ul {
  list-style: none; /* Entfernt Standardpunkte */
  padding: 0;
  margin: 0;
  display: flex; /* Flexbox auf die Liste anwenden */
  flex-direction: column; /* Vertikale Anordnung der Links */
  justify-content: space-between; /* Gleichmäßiger Abstand zwischen den Links */
  height: 100%; /* Volle Höhe des übergeordneten Containers */
}

.navbar li {
  text-align: center;
}

.navbar ul li form label{
  cursor: pointer;
}

.submit {
  display: none;
}

.main-container {
  width: 100%; /* Restliche Breite */
  background-color: <?php echo $main_container_color; ?>;
  padding: 20px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
}

.header {
  position: relative;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  padding: 20px;
  background-color: #2c3e50;
  color: white;
  font-size: 1.5rem;
  text-align: left; /* Header-Text linksbündig */
}

.header-text {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

.header-text:hover .info-box {
  display: block; /* Zeigt die Info-Box beim Hover */
}

.header-icon {
  font-size: 2rem; /* Icon bleibt mittig */
  float: right;
}

.content {
  background-color: <?php echo $content_color; ?>;
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  flex-grow: 1; /* Nimmt den verbleibenden Platz ein */
  overflow: hidden;
  position: relative;
  padding-right: 2
}

.content {
    object-fit: fill;
    align-items: center;
}

.range_reset {
    display: flex;
    align-items: center; /* Vertikale Ausrichtung */
    gap: 10px; /* Abstand zwischen Range und Reset-Button */
    justify-content: flex-start; /* Elemente linksbündig */
}

#audio-icon {
    display: block;
    width: <?php echo $cover_size; ?>; /* Größe des Icons */
    margin: 20px auto; /* Zentriert das Icon */
    cursor: pointer; /* Zeigt an, dass das Icon klickbar ist */
}
  </style>
</head>
<body>
  <div class="layout">
    <!-- Navbar rechts -->
    <div class="navbar">

      <ul>
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get">
            <label for="movie"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="m160-800 80 160h120l-80-160h80l80 160h120l-80-160h80l80 160h120l-80-160h120q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800Zm0 240v320h640v-320H160Zm0 0v320-320Z"/></svg></label>
            <input type="hidden" name="category" value="filme">
            <button type="submit" id="movie" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
                
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get">
            <label for="serie"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M320-320h480v-400H320v400Zm0 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z"/></svg></label>
            <input type="hidden" name="category" value="serien">
            <button type="submit" id="serie" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
              
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get">
            <label for="audio"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M400-120q-66 0-113-47t-47-113q0-66 47-113t113-47q23 0 42.5 5.5T480-418v-422h240v160H560v400q0 66-47 113t-113 47Z"/></svg></label>
            <input type="hidden" name="category" value="hoerspiele">
            <button type="submit" id="audio" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
        
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get">
            <label for="puppen"><svg width= "<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg></label>
            <input type="hidden" name="category" value="puppen">
            <button type="submit" id="puppen" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>

        <li>
          <!-- a single icon with an formulare -->
          <form action="audio.php" method="get">
            <label for="resume"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M240-240v-480h80v480h-80Zm160 0 400-240-400-240v480Zm80-141v-198l165 99-165 99Zm0-99Z"/></svg></label>
            <input type="hidden" name="category" value="resume">
            <button type="submit" id="resume" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
      </ul>
    </div>

    <!-- Hauptcontainer links -->
    <div class="main-container">
      <!-- Bereich über dem Container -->
      <div class="header">
        <span class="header-icon">
          <svg xmlns="http://www.w3.org/2000/svg" height="2rem" viewBox="0 -960 960 960" fill="white"><path d="M560-160v-80h104L537-367l57-57 126 126v-102h80v240H560Zm-344 0-56-56 504-504H560v-80h240v240h-80v-104L216-160Zm151-377L160-744l56-56 207 207-56 56Z"/></svg>
        </span>
      </div>

      <!-- Hauptinhalt -->
      <div class="content">
          <?php
              $cover_path = basename($user_data["current_file"]);

              $path = "";
              
              for ($i = 0; $i < strlen($cover_path) - 1; $i++) {
                  $path .= $cover_path[$i];

                  if ($cover_path[$i] === ".") {
                      break;
                  }
              }

              $allowed_file_types = loading_user_data("allowed_file_types.json");
              $all_img_ends = $allowed_file_types["img"];

              $found_exact_file_img = false; // Variable to check if an exact file image is found
              $found_dir_file_img = false; // Variable to check if a directory file image is found

              foreach ($all_img_ends as $img_end) {
                  if (is_file("img/" . $path . $img_end)) {
                      $cover_path = "img/" . $path . $img_end;
                      $found_exact_file_img = true; // Set to true if an exact file image is found
                      break;
                  }
              }

              if (!$found_exact_file_img) {
                  $cover_path = $user_data["current_file"];

                  $seperated_path = explode("/", $cover_path);

                  $path = $seperated_path[count($seperated_path) - 2];

                  foreach ($all_img_ends as $img_end) {
                    if (is_file("img/" . $path . "." . $img_end)) {
                        $cover_path = "img/" . $path . "." . $img_end;
                        $found_dir_file_img = true; // Set to true if a directory file image is found
                        break;
                    }
                  }
              }

              if (!$found_exact_file_img && !$found_dir_file_img) {
                  $cover_path = "feedback/no_audio_cover.png"; // Default cover image if no specific image is found
              }
          ?>
        
          <img id="audio-icon" src="<?php echo $cover_path; ?>">

          <?php
              $media_progress = loading_user_data("media_progress.json"); 
              
              $audio_path = str_replace($user_data["main_path"], $user_data["path_link"], $user_data["current_file"]);

              $current_time = $media_progress[$audio_path]; // current time of the audio

              if (!is_float($current_time)) {
                  $current_time = 0;
              }
          ?>

          <audio id="audio_media" autoplay src="<?php echo $audio_path; ?>" ></audio>

          <div class="range_reset">
            <input type="range" id="audio-progress-range" min="0" max="100" value="0" step="0.001" style="width:80%;margin:20px auto;display:block;">    
            <button id="reset_button">Reset</button>
          </div>
          <script>
              const audio = document.getElementById("audio_media");
              console.log(audio);
              const audioIcon = document.getElementById("audio-icon");
              console.log(audioIcon);
              const progressRange = document.getElementById("audio-progress-range");
              console.log(progressRange);

              // Play or pause audio on icon click
              audioIcon.addEventListener("click", () => {
                  if (audio.paused) {
                      audio.play();
                      console.log('Audio started playing');
                  } else {
                      audio.pause();
                      console.log('Audio paused');
                  }
              });

              audio.addEventListener('loadedmetadata', () => {
                  audio.currentTime = <?php echo $current_time; ?>; //Set the start time
                  console.log('Current time: ' + audio.currentTime);

                  if (resume === 'resume') {
                      resume = 'none'; // Reset resume variable
                      audio.pause();
                      setTimeout(() => {
                          audio.play();
                          console.log('Audio resumed playing');
                      }, 2000);
                  }
              });

              // === Synchronisation Range <-> Audio ===
              // Aktualisiere den Range-Input, wenn das Audio abspielt
              audio.addEventListener('timeupdate', () => {
                  if (!audio.duration) return;
                  progressRange.value = (audio.currentTime / audio.duration) * 100;
              });

              // Wenn der User den Range-Input bewegt, Audiozeit anpassen
              progressRange.addEventListener('input', (e) => {
                  if (!audio.duration) return;
                  const percent = parseFloat(progressRange.value) / 100;
                  audio.currentTime = percent * audio.duration;
              });

              // Klick auf beliebige Stelle im Range-Input setzt die Zeit
              progressRange.addEventListener('mousedown', (e) => {
                  progressRange.isSeeking = true;
              });
              progressRange.addEventListener('mouseup', (e) => {
                  progressRange.isSeeking = false;
              });
              // Optional: Touch Events für mobile Geräte
              progressRange.addEventListener('touchstart', (e) => {
                  progressRange.isSeeking = true;
              });
              progressRange.addEventListener('touchend', (e) => {
                  progressRange.isSeeking = false;
              });

              // Send progress data to the server periodically
              setInterval(() => {
                  const current_time = audio.currentTime;
                  const file_path = audio.getAttribute('src');

                  // Dynamically create an object where the key is the file_path
                  const data = {};
                  data[file_path] = current_time;

                  // Send progress data to the server
                  sendDataViaPOST('getting_media_progress.php', data);
              }, 5000);

              const reset_button = document.getElementById("reset_button");
              reset_button.addEventListener("click", () => {
                  audio.currentTime = 0;
                  audio.pause(); // Optional: Audio pausieren, wenn zurückgesetzt wird
              });
          </script>

      </div>
    </div>
  </div>
</body>
</html>