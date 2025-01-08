<?php

  // Session starten
  session_start();

  // Alle Session-Keys

  // page
  //

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout</title>
  <script src="no_context_menu.js"></script>
  <script src="cookie.js" defer></script>
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
  width: 20%; /* Festlegen der Navbar-Breite */
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
  width: 80%; /* Restliche Breite */
  background-color: #ecf0f1;
  padding: 20px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
}

.header {
  position: relative;
  padding: 20px;
  background-color: #2c3e50;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  color: white;
  font-size: 1.5rem;
  text-align: left; /* Header-Text linksbündig */
}

.header-text {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

.info-box {
  position: absolute;
  top: 100%; /* Zeigt die Info-Box direkt unter dem Header-Text an */
  left: 0; /* Positioniert die Info-Box linksbündig zum Header-Text */
  width: 25vw;
  height: 35vh;
  background-color: white;
  color: #333;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 10px;
  text-align: center; /* Text in der Box bleibt zentriert */
  display: none; /* Versteckt die Info-Box standardmäßig */
  z-index: 10;
}

.info-box img {
  width: 80%;
  height: 80%;
  margin-bottom: 10px;
}

.info-box p {
  margin: 0;
}

.header-text:hover .info-box {
  display: block; /* Zeigt die Info-Box beim Hover */
}

.header-icon {
  font-size: 2rem;
  float: right;
}

.content {
  background-color: white;
  padding: 20px;
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  flex-grow: 1; /* Nimmt den verbleibenden Platz ein */
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Kleinere Karten mit flexibler Anzahl */
  gap: 15px; /* Geringerer Abstand zwischen den Karten */
  padding: 20px;
  border-radius: 8px;
}

.card {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 10px; /* Weniger Padding für kleinere Karten */
  text-align: center;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  height: 200px; /* Fixierte Höhe für einheitliche Kartengröße */
  min-width: 5%;
  display: flex;
  flex-direction: column;
  cursor: pointer;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

.card h3 {
  margin: 0 0 8px;
  font-size: 1.2rem; /* Kleinere Schriftgröße */
}

.card p {
  margin: 0;
  color: #666;
  font-size: 0.9rem; /* Kleinere Beschreibung */
}

.bigCard {
  display: none; /* Standardmäßig ausgeblendet */
  position: fixed; /* Fixiert, um sicherzustellen, dass es über anderen Elementen ist */
  top: 25%; /* Zentrierte Position */
  left: 25%;
  width: 0%; /* Skalierung */
  height: 0%;
  background-color: transparent; /* Hintergrundfarbe */
  z-index: 999; /* Höhere Priorität */
  pointer-events: none; /* Verhindert, dass das Overlay Klicks abfängt */
  justify-content: center;
  flex-direction: row;
}

.bigCard img {
  height: 100%;
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
          <form action="browse.php" method="post">
            <label for="filme"><svg width="30%" viewBox="0 -960 960 960" fill="white"><path d="m160-800 80 160h120l-80-160h80l80 160h120l-80-160h80l80 160h120l-80-160h120q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800Zm0 240v320h640v-320H160Zm0 0v320-320Z"/></svg></label>
            <input type="hidden" name="category" value="filme">
            <button type="submit" id="filme" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
                
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="post">
            <label for="serien"><svg width="30%" viewBox="0 -960 960 960" fill="white"><path d="M320-320h480v-400H320v400Zm0 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z"/></svg></label>
            <input type="hidden" name="category" value="serien">
            <button type="submit" id="serien" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
              
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="post">
            <label for="audio"><svg width="30%" viewBox="0 -960 960 960" fill="white"><path d="M400-120q-66 0-113-47t-47-113q0-66 47-113t113-47q23 0 42.5 5.5T480-418v-422h240v160H560v400q0 66-47 113t-113 47Z"/></svg></label>
            <input type="hidden" name="category" value="hoerspiele">
            <button type="submit" id="audio" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
        
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="post">
            <label for="puppen"><svg width="30%" viewBox="0 -960 960 960" fill="white"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg></label>
            <input type="hidden" name="category" value="puppen">
            <button type="submit" id="puppen" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
              
        <li id="li-up">
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="post">
            <label for="up"><svg width="30%" viewBox="0 -960 960 960" fill="white"><path d="M440-160v-487L216-423l-56-57 320-320 320 320-56 57-224-224v487h-80Z"/></svg></label>
            <input type="hidden" name="category" value="up">
            <button type="submit" id="up" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>

        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="post">
            <strong id="page" style="font-size: 500%;">1</strong>
          </form>
        </li>
              
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="post">
            <label for="down"><svg width="30%" viewBox="0 -960 960 960" fill="white"><path d="M440-800v487L216-537l-56 57 320 320 320-320-56-57-224 224v-487h-80Z"/><path d="M440-800v487L216-537l-56 57 320 320 320-320-56-57-224 224v-487h-80Z"/></svg></label>
            <input type="hidden" name="category" value="down">
            <button type="submit" id="down" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>

        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="post">
            <label for="resume"><svg width="30%" viewBox="0 -960 960 960" fill="white"><path d="M240-240v-480h80v480h-80Zm160 0 400-240-400-240v480Zm80-141v-198l165 99-165 99Zm0-99Z"/></svg></label>
            <input type="hidden" name="category" value="resume">
            <button type="submit" id="resume" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
        <script>
          const page = document.getElementById("page").innerHTML;

          if (page == 1) {
            document.getElementById("li-up").style.display = "none";
          }
        </script>
      </ul>
    </div>

    <!-- Hauptcontainer links -->
    <div class="main-container">
      <!-- Bereich über dem Container -->
      <div class="header">
        <div class="header-text">
          Hover über mich!
          <div class="info-box">
            <img src="https://media04.meinbezirk.at/article/2017/11/08/2/11285172_XL.jpg?1559975767" alt="Info-Bild">
            <p>Dies ist eine Info-Box mit Bild und Text.</p>
          </div>
        </div>
        <span class="header-icon">
          <svg xmlns="http://www.w3.org/2000/svg" height="2rem" viewBox="0 -960 960 960" fill="white"><path d="M560-160v-80h104L537-367l57-57 126 126v-102h80v240H560Zm-344 0-56-56 504-504H560v-80h240v240h-80v-104L216-160Zm151-377L160-744l56-56 207 207-56 56Z"/></svg>
        </span>
      </div>
      <!-- Hauptinhalt -->
      <div class="content">
        <div class="grid-container">
          <script src="send_data.js"></script>
          <script src="local_storage.js"></script>
          <div style="display: none;">
            <!--<audio id="audio">  
              <source src="./tts/output/Alf.wav" type="audio/wav" id="audio_src"/>
            </audio>  -->
          </div>
          <div id="bigCard" class="bigCard"></div>
          <!--<script>
            const audio = document.getElementById("audio");
            const source = document.getElementById("audio_src");
          </script>-->
          <?php 

            require "console_log.php";

            require "loading_user_data.php";

            function loading_cards($directory) {
              
              // TODO Die Möglichkeit das Videos angezeigt werden muss implementiert werden

              require "log.php";

              $log = new Log;

              console_log($directory);

              if (is_dir($directory)) {

                // Dateien und Ordner auslesen
                $items = scandir($directory);

                $id = 0; // solves problems if an item has spaces in it

                foreach ($items as $item) {
                    // Nur Ordner anzeigen (ohne "." und "..")
                    if ($item !== "." && $item !== ".." && is_dir($directory . "/" . $item) && $item !== ".wd_tv") {
                      
                        if (!(is_file("img/" . $item . ".ico"))){
                          if (loading_user_data("user_data.json")["log"]) {

                            // Toggles the log on and off
                            
                            $message = "No Image: " . $item;

                            $log->saving_log($message);
                          }
                        } 

                        $id = $id + 1; 

                        console_log('./img/' . $item . '.ico');

                        echo '
                        <div class="card" id="'. $item . '" style="background-image: url("./img/' . $item . '.ico"); background-size: cover; background-position: center;">
                            
                            <h3>' . htmlspecialchars($item) . '</h3>
                            <form action="browse.php" method="post" id="form' . $item . '">
                                <input type="hidden" name="cardDir" value="'. $directory . "/"  . htmlspecialchars($item) . '">
                            </form>
                        </div> 

                        <script defer>
                            const element' . $id . ' = document.getElementById("' . $item . '");

                            const delay' . $id . ' = 1000; // Wartezeit in Millisekunden (2 Sekunden)
                            const bigCard' . $id . ' = document.getElementById("bigCard");

                            // triggers if the user clicks at the div
                            element' . $id . '.addEventListener("click", () => {
                              document.getElementById("form' . $item . '").submit();
                            });

                            // triggers if the cursor enters the div
                            element' . $id . '.addEventListener("mouseenter", () => {
                              console.log("Cursor ist auf dem Element.");
                              
                              // Starte den Timer
                              timer = setTimeout(() => {
                                console.log("Der Cursor war 2 Sekunden auf dem Element."); // TODO Sound ist noch nicht implementiert

                                send_data("' . $item . '");

                                if (getCookie("audio_file_path") == null) {
                                  console.log("Cookie not found");
                                }else{
                                  audio_play(getCookie("audio_file_path"));
                                }
                                  
                                //audio_src.src= output; // definiert in einer andere JS-Datei
                                //audio.play();

                                bigCard' . $id . '.style.display = "block";
                                bigCard' . $id . '.style.width = "50%";
                                bigCard' . $id . '.style.height = "50%";
                                console.log("bigCard visible");

                                const bigCardHTML = \'<img src="img/' . rawurlencode($item) . '.ico" alt="Fehler beim Laden des Bildes">\';

                                bigCard.innerHTML = bigCardHTML;
                              }, delay' . $id . ');
                            });

                            // Event, wenn die Maus das Element verlässt
                            element' . $id . '.addEventListener("mouseleave", () => {
                              console.log("Cursor hat das Element verlassen.");
                              
                              // Timer stoppen, falls noch nicht abgelaufen
                              clearTimeout(timer);

                              bigCard.style.display = "none";
                              bigCard' . $id . '.style.width = "0%";
                              bigCard' . $id . '.style.height = "0%";
                              
                              audio_stop();
                            });

                        </script>
                        ';
                    }
                    elseif (is_file($directory . "/" . $item)) {}
                };
              }
              elseif (is_file($directory)) {

                require "movie.php";

              }
              
              else {
                echo "<p>Das Verzeichnis wurde nicht gefunden.</p>";

                if (loading_user_data("user_data.json")["log"]) {

                  // Toggles the log on and off
                  
                  $message = "Verzeichnis nicht gefunden. Path: " . $directory;

                  $log->saving_log($message);
                }
              };
            };

            function pages() {

              
            };

            if (isset($_POST["submit"])) {

                // variables

                $main_path = loading_user_data("user_data.json");

                $category = $_POST["category"];

                $path = $main_path["main_path"] . "/" . $category;

                // TODO Implementierung von Seiten und der resume Funktion

                switch ($category) {
                    case "filme":
                        loading_cards($path);
                        $_SESSION["page"] = null;
                        break;
                    case "serien":
                        loading_cards($path);
                        $_SESSION["page"] = null;
                        break;
                    case "hoerspiele":
                        loading_cards($path);
                        $_SESSION["page"] = null;
                        break;
                    case "puppen":
                        loading_cards($path);
                        $_SESSION["page"] = null;
                        break;
                    case "up":
                        loading_cards($path);
                        break;
                    case "down":
                        loading_cards($path);
                        break;
                    case "resume":
                        loading_cards($path);
                        break;
                };
            }

            if (isset($_POST["cardDir"])) {

              $card_dir = $_POST["cardDir"];

              $_SESSION["page"] = null;

              console_log($card_dir);

              loading_cards($card_dir);

            };
          ?>

            
        </div>
      </div>
    </div>
  </div>
</body>
</html>