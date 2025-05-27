<?php

use function PHPSTORM_META\type;

require "transforming_user_data.php";

$css = loading_user_data("css.json");

$navbar_width = $css["navbar_width"];
$navbar_color = $css["navbar_color"];
$icon_size = $css["icon_size"];
$main_container_color = $css["main_container_color"];
$content_color = $css["content_color"];
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
          <form action="browse.php" method="get">
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

        <input type="range" id="video-progress-range" min="0" max="100" value="0" step="0.001" style="width:80%;margin:20px auto;display:block;">
        <button id="reset-button" style="display:block;margin:20px auto;">Reset</button>
        <!-- Vollbild-Button entfernt -->

        <!-- TODO Den Rahmen mit Navbar und Titel usw. hinzufügen.-->

        <?php
            $user_data = loading_user_data("user_data.json");

            $video_path = str_replace($user_data["main_path"], $user_data["path_link"], $user_data["current_file"]);
            
            $media_progress = loading_user_data("media_progress.json");
        ?> 

        <video autoplay id="movie">
          <source src="<?php echo $video_path; ?>" type="video/mp4">
        </video>
    
        <script> 

            console.log("Video path: " + "<?php echo $video_path; ?>");
        
            const movie = document.getElementById("movie");
            const progressRange = document.getElementById("video-progress-range");

            });

            // checks if the video has ended
            movie.addEventListener('ended', () => {
                console.log('Das Video ist zu Ende.');
            });

            // === Synchronisation Range <-> Video ===
            // Aktualisiere den Range-Input, wenn das Video abspielt
            movie.addEventListener('timeupdate', () => {
                if (!movie.duration) return;
                progressRange.value = (movie.currentTime / movie.duration) * 100;
            });

            // Wenn der User den Range-Input bewegt, Videozeit anpassen
            progressRange.addEventListener('input', (e) => {
                if (!movie.duration) return;
                const percent = parseFloat(progressRange.value) / 100;
                movie.currentTime = percent * movie.duration;
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

            // === Vollbild beim Abspielen, aber nicht beim Pausieren ===
            function triggerFullscreen() {
                if (document.fullscreenElement) return; // Bereits im Vollbild
                if (movie.requestFullscreen) {
                    movie.requestFullscreen();
                } else if (movie.webkitRequestFullscreen) {
                    movie.webkitRequestFullscreen();
                } else if (movie.msRequestFullscreen) {
                    movie.msRequestFullscreen();
                }
            }

            movie.addEventListener('play', () => {
                triggerFullscreen();
            });
            movie.addEventListener('pause', () => {
                if (document.fullscreenElement && document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitFullscreenElement && document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msFullscreenElement && document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            });

            const resetButton = document.getElementById("reset-button");
            resetButton.addEventListener("click", () => {
                movie.currentTime = 0;
                movie.pause(); // Optional: Video pausieren, wenn zurückgesetzt wird
            });
            
        </script>        
        <script src="no_context_menu.js"></script>

      </div>
    </div>
  </div>
</body>
</html>     