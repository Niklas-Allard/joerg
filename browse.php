<?php
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
  background-color:<?php echo $navbar_color; ?>;
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
  width: 100%;
  background-color: "<?php echo $main_container_color; ?>";
  padding: 20px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
}

.content {
  background-color: <?php echo $content_color; ?>;
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
  <?php 
  if ($user_data["show_title"] == true) {
    echo 'font-size:' . '$css["title_size"]'; // Kleinere Schriftgröße
  } elseif ($user_data["show_title"] == false) {
    echo "display: none;";
  }
  ?>
  margin: 0 0 8px
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
          <form action="browse.php" method="get" id="form_filme">
            <label for="filme"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="m160-800 80 160h120l-80-160h80l80 160h120l-80-160h80l80 160h120l-80-160h120q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800Zm0 240v320h640v-320H160Zm0 0v320-320Z"/></svg></label>
            <input type="hidden" name="category" value="filme">
            <button type="submit" id="filme" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
                
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get" id="form_serien">
            <label for="serien"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M320-320h480v-400H320v400Zm0 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z"/></svg></label>
            <input type="hidden" name="category" value="serien">
            <button type="submit" id="serien" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
              
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get" id="form_hoerspiele">
            <label for="audio"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M400-120q-66 0-113-47t-47-113q0-66 47-113t113-47q23 0 42.5 5.5T480-418v-422h240v160H560v400q0 66-47 113t-113 47Z"/></svg></label>
            <input type="hidden" name="category" value="hoerspiele">
            <button type="submit" id="audio" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
        
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get" id ="form_puppen">
            <label for="puppen"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg></label>
            <input type="hidden" name="category" value="puppen">
            <button type="submit" id="puppen" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
              
        <li id="li_up">
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get">
            <label for="up"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M440-160v-487L216-423l-56-57 320-320 320 320-56 57-224-224v487h-80Z"/></svg></label>
            <input type="hidden" name="category" value="up">
            <button type="submit" id="up" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>

        <li>

            <strong id="page" style="font-size: 500%;">
              <?php
                $user_data = loading_user_data("user_data.json");
                
                if (isset($_GET["category"])) {

                  if ($_GET["category"] == "up" && $user_data["current_page"] != 1) {
                    $user_data["current_page"] = $user_data["current_page"] - 1;
                  }
                  elseif ($_GET["category"] == "down") {
                    $user_data["current_page"] = $user_data["current_page"] + 1;
                  };

                  echo '<script>document.getElementById("page").innerHTML = ' . $user_data["current_page"] . '; console.log("display page");</script>';
                };
              ?>
            </strong>
          
        </li>
              
        <li id="li_down" style="display: inline;">
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get">
            <label for="down"><svg width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M440-800v487L216-537l-56 57 320 320 320-320-56-57-224 224v-487h-80Z"/><path d="M440-800v487L216-537l-56 57 320 320 320-320-56-57-224 224v-487h-80Z"/></svg></label>
            <input type="hidden" name="category" value="down">
            <button type="submit" id="down" class="submit" name="submit" value="submit"></button>
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
        <script>
          const page = document.getElementById("page").innerHTML;

          if (page == 1) {
            document.getElementById("li_up").style.display = "none";
          }
        </script>
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
        <div class="grid-container">
          <script src="send_data.js"></script>
          <div style="display: none;" id="audio_container">
            <audio id="audio_element">  
              <source src="tts/output/Die Fraggles - Back to the Rock.wav" type="audio/wav" id="audio_src"/>
            </audio>
          </div>
          <div id="bigCard" class="bigCard"></div>
          <script>

            const audio_div = document.getElementById("audio_container");

          </script>
          <?php 

            require "console_log.php";

            function loading_cards($directory) {
              
              // TODO Die Möglichkeit das Videos angezeigt werden muss implementiert werden

              require "log.php";

              console_log($directory);

              if (is_dir($directory)) {

                // Dateien und Ordner auslesen
                $items = scandir($directory);

                $id = 0; // solves problems if an item has spaces in it
                
                $user_data = loading_user_data("user_data.json");

                $user_data["current_directory"] = $directory;

                saving_user_data($user_data, "user_data.json");
                
                $counter = 0; // for the page system | counts the carts

                foreach ($items as $item) {

                    // Nur Ordner anzeigen (ohne "." und "..")
                    if ($item !== "." && $item !== ".." && is_dir($directory . "/" . $item) && $item !== ".wd_tv") {
                      
                        if (!(is_file("img/" . $item . ".ico"))){
                          if (loading_user_data("user_data.json")["log"]) {

                            // Toggles the log on and off
                            
                            $message = "No Image: " . $item;

                            $log = new Log();

                            $log->saving_log($message);
                          }
                        }

                        // page system
                        
                        $counter++;

                        if ($counter > ($user_data["elements_per_page"]) * ($user_data["current_page"])) { # sets the limit of the page
                          break;
                        }
                        elseif ($counter <= ($user_data["elements_per_page"]) * ($user_data["current_page"] - 1)) { # skips the elements of the previous page
                          continue;
                        };
                        
                        $id = $id + 1; 

                        console_log('img/' . $item . '.ico'); // background-size: cover; background-position: center;

                        $item_img_path = $item;
                      
                        $item_img_path = str_replace(" ", "\\00a0", $item_img_path);

                        echo '
                        <div class="card" id="'. $item . '" style="background-image: url(\'img/' . $item . '.ico\'); background-size: cover; background-position: center;">
                            
                            <h3>' . htmlspecialchars($item) . '</h3>
                            <form action="browse.php" method="get" id="form' . $item . '">
                                <input type="hidden" name="cardDir" value="'. $directory . "/"  . htmlspecialchars($item) . '">
                            </form>
                        </div> 

                        <script defer>
                            const element' . $id . ' = document.getElementById("' . $item . '");

                            const delay' . $id . ' = 2000; // Wartezeit in Millisekunden (2 Sekunden)
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
                                console.log("Der Cursor war 2 Sekunden auf dem Element.");

                                let item' . $id . ' = "' . $item . '";

                                let newItem' . $id . ' = ""

                                if (item' . $id . '.indexOf("(") !== -1) {
                                    let counter = 0;
                                    for (let i = 0; i < item' . $id . '.length; i++) {
                                        const letter = item' . $id . '[i];
                                        if (letter === "(") {
                                            counter += 1;
                                        }
                                        if (counter === (item' . $id . '.match(/\(/g) || []).length) {
                                            break;
                                        }
                                        newItem' . $id . ' += letter;
                                    }
                                } else if (item' . $id . '.indexOf(".") !== -1) {
                                    let iterated_on_the_point = false;
                                    for (let i = item' . $id . '.length - 1; i >= 0; i--) {
                                        const letter = item' . $id . '[i];

                                        if (iterated_on_the_point === true) {
                                            newItem' . $id . ' += letter;
                                        }

                                        if (letter === ".") {
                                            iterated_on_the_point = true;
                                        }
                                    }
                                    // Um die Reihenfolge wie im Original zu erhalten:
                                    newItem' . $id . ' = newItem' . $id . '.split("").reverse().join("");
                                } 

                                console.log(newItem' . $id . ');

                                item' . $id . ' = newItem' . $id . ';


                                item' . $id . ' = item' . $id . '.replace("ö", "oe");
                                item' . $id . ' = item' . $id . '.replace("ä", "ae");
                                item' . $id . ' = item' . $id . '.replace("ü", "ue");
                                item' . $id . ' = item' . $id . '.replace("Ö", "Oe");
                                item' . $id . ' = item' . $id . '.replace("Ä", "Ae");
                                item' . $id . ' = item' . $id . '.replace("Ü", "Ue");
                                item' . $id . ' = item' . $id . '.replace("ß", "ss");

                                
                                const audio_content' . $id . ' = "<audio id=\"audio_element\">" + 
                                  "<source src=\"tts/output/" + item' . $id . ' + ".wav\" type=\"audio/wav\" id=\"audio_src\"/>" + 
                                "</audio>";

                                audio_div.innerHTML = audio_content' . $id . ';

                                document.getElementById("audio_element").play();

                                bigCard' . $id . '.style.display = "block";
                                bigCard' . $id . '.style.width = "50%";
                                bigCard' . $id . '.style.height = "50%";
                                console.log("bigCard visible");

                                const bigCardHTML = \'<img src="img/' . rawurlencode($item) . '.ico" alt="Fehler beim Laden des Bildes">\';

                                bigCard.innerHTML = bigCardHTML;
                              }, delay' . $id . ');

                              // Starte den Timer
                              timer = setTimeout(() => {

                                send_data("' . $item . '");
                              }, 500);
                            });

                            // Event, wenn die Maus das Element verlässt
                            element' . $id . '.addEventListener("mouseleave", () => {
                              console.log("Cursor hat das Element verlassen.");
                              
                              // Timer stoppen, falls noch nicht abgelaufen
                              clearTimeout(timer);

                              bigCard.style.display = "none";
                              bigCard' . $id . '.style.width = "0%";
                              bigCard' . $id . '.style.height = "0%";
                              
                              //audio_stop();
                            });

                        </script>
                        ';
                    }
                    elseif (is_file($directory . "/" . $item)) {  // TODO Video/Audio Support
                      
                      $id = $id + 1; 
                      
                      echo '
                      <div class="card" id="'. $item . '" style="background-image: url(\'img/' . $item . '.ico\'); background-size: cover; background-position: center;">
                            
                            <h3>' . htmlspecialchars($item) . '</h3>
                            <form action="browse.php" method="get" id="form' . $item . '">
                                <input type="hidden" name="cardDir" value="'. $directory . "/"  . htmlspecialchars($item) . '">
                            </form>
                        </div> 

                        <script defer>
                            const element' . $id . ' = document.getElementById("' . $item . '");

                            const delay' . $id . ' = 2000; // Wartezeit in Millisekunden (2 Sekunden)
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
                                console.log("Der Cursor war 2 Sekunden auf dem Element.");

                                let item' . $id . ' = "' . $item . '";

                                let newItem' . $id . ' = ""

                                if (item' . $id . '.indexOf("(") !== -1) {
                                    let counter = 0;
                                    for (let i = 0; i < item' . $id . '.length; i++) {
                                        const letter = item' . $id . '[i];
                                        if (letter === "(") {
                                            counter += 1;
                                        }
                                        if (counter === (item' . $id . '.match(/\(/g) || []).length) {
                                            break;
                                        }
                                        newItem' . $id . ' += letter;
                                    }
                                } else if (item' . $id . '.indexOf(".") !== -1) {
                                    let iterated_on_the_point = false;
                                    for (let i = item' . $id . '.length - 1; i >= 0; i--) {
                                        const letter = item' . $id . '[i];

                                        if (iterated_on_the_point === true) {
                                            newItem' . $id . ' += letter;
                                        }

                                        if (letter === ".") {
                                            iterated_on_the_point = true;
                                        }
                                    }
                                    // Um die Reihenfolge wie im Original zu erhalten:
                                    newItem' . $id . ' = newItem' . $id . '.split("").reverse().join("");
                                } 

                                console.log(newItem' . $id . ');

                                item' . $id . ' = newItem' . $id . ';


                                item' . $id . ' = item' . $id . '.replace("ö", "oe");
                                item' . $id . ' = item' . $id . '.replace("ä", "ae");
                                item' . $id . ' = item' . $id . '.replace("ü", "ue");
                                item' . $id . ' = item' . $id . '.replace("Ö", "Oe");
                                item' . $id . ' = item' . $id . '.replace("Ä", "Ae");
                                item' . $id . ' = item' . $id . '.replace("Ü", "Ue");
                                item' . $id . ' = item' . $id . '.replace("ß", "ss");

                                
                                const audio_content' . $id . ' = "<audio id=\"audio_element\">" + 
                                  "<source src=\"tts/output/" + item' . $id . ' + ".wav\" type=\"audio/wav\" id=\"audio_src\"/>" + 
                                "</audio>";

                                audio_div.innerHTML = audio_content' . $id . ';

                                document.getElementById("audio_element").play();

                                bigCard' . $id . '.style.display = "block";
                                bigCard' . $id . '.style.width = "50%";
                                bigCard' . $id . '.style.height = "50%";
                                console.log("bigCard visible");

                                const bigCardHTML = \'<img src="img/' . rawurlencode($item) . '.ico" alt="Fehler beim Laden des Bildes">\';

                                bigCard.innerHTML = bigCardHTML;
                              }, delay' . $id . ');

                              // Starte den Timer
                              timer = setTimeout(() => {

                                send_data("' . $item . '");
                              }, 500);
                            });

                            // Event, wenn die Maus das Element verlässt
                            element' . $id . '.addEventListener("mouseleave", () => {
                              console.log("Cursor hat das Element verlassen.");
                              
                              // Timer stoppen, falls noch nicht abgelaufen
                              clearTimeout(timer);

                              bigCard.style.display = "none";
                              bigCard' . $id . '.style.width = "0%";
                              bigCard' . $id . '.style.height = "0%";
                              
                              //audio_stop();
                            });

                        </script>';
                    }
                };

                $user_data = loading_user_data("user_data.json");

                $page_limit = ceil(count($items) / $user_data["elements_per_page"]);

                $user_data["max_pages"] = $page_limit;

                $user_data["overall_cards"] = count($items);

                saving_user_data($user_data, "user_data.json");

                // removing the down arrow if the max limit reached

                if ($user_data["max_pages"] <= $user_data["current_page"]) {
                  echo '<script>document.getElementById("li_down").style.display = "none";</script>';
                };
              }
              elseif (is_file($directory)) {

                // saving the last watched file in a category or directory
                $last_watched_file = loading_user_data("last_watched_file.json");
                $user_data = loading_user_data("user_data.json");
                
                // saving the last watched file in the directory
                $last_watched_file[$user_data["current_directory"]] = $directory; 
                
                // saving the last watched file in the category

                $seperated_path = explode("/", $directory);

                // deciding in which category the user currently is
                switch (true) {
                    case in_array("filme", $seperated_path):
                        $last_watched_file[$user_data["main_path"] . "/" . "filme"] = $directory;
                        break;
                    case in_array("serien", $seperated_path):
                        $last_watched_file[$user_data["main_path"] . "/" . "serien"] = $directory;
                        break;
                    case in_array("hoerspiele", $seperated_path):
                        $last_watched_file[$user_data["main_path"] . "/" . "hoerspiele"] = $directory;
                        break;
                    case in_array("puppen", $seperated_path):
                        $last_watched_file[$user_data["main_path"] . "/" . "puppen"] = $directory;
                        break;
                }

                saving_user_data($last_watched_file, "last_watched_file.json");

                // saving the last fil & the page in user_data.json
                
                $user_data["current_file"] = $directory;
                
                $user_data["current_page"] = 1;

                saving_user_data($user_data, "user_data.json");

                require "movie_or_audio.php";

                // extract the file name from the directory path

                $file_name = ""; // saves the name of the file

                for ($i = 1; $i < strlen($directory); $i++) {
                  if ($directory[-$i] == "/") {
                    break;
                  };
                  $file_name .= $directory[-$i];
                };

                // reverse the string
                $file_name = strrev($file_name);

                $type_file = movie_or_audio($file_name);

                if ($type_file == "movie") {
                  echo "movie";
                  reloading_cards("movie");
                }
                elseif ($type_file == "audio") {
                  echo "audio";
                  reloading_cards("audio");
                }

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

            function reloading_cards($page_movie_or_audio) { // page_movie_or_audio means if the page, movie or audio called the function
              // Displays the cards if the page number was changed

              $user_data = loading_user_data("user_data.json");      
              
              echo '
              <script>

                let link = "";

                const page_movie_or_audio = "' . $page_movie_or_audio . '";

                const url = window.location.href;
                
                let counter = 0;

                let current_dir = "' . $user_data["current_directory"] . '";

                if (current_dir.includes("filme")) {
                  current_dir = "filme";
                }
                else if (current_dir.includes("serien")) {
                  current_dir = "serien";
                }
                else if (current_dir.includes("hoerspiele")) {
                  current_dir = "hoerspiele";
                }
                else if (current_dir.includes("puppen")) {
                  current_dir = "puppen";
                }

                while (counter + 1 != url.length) {  
                  if (url[counter] == "?") {
                    break;
                  }

                  link += url[counter];

                  counter++;
                };

                if (page_movie_or_audio == "page") {
                  window.location.href = link + "?" + "category=" + current_dir + "&submit=reload";
                }
                else if (page_movie_or_audio == "movie") {
                  window.location.href = "movie.php";
                }
                else if (page_movie_or_audio == "audio") {
                  window.location.href = "audio.php";
                };
              </script>
              ';
            };

              

            function page_down() {
              $user_data = loading_user_data("user_data.json");

              $user_data["current_page"] = $user_data["current_page"] + 1;

              reloading_cards("page");
              saving_user_data($user_data, "user_data.json");
            };

            function page_up() {
              $user_data = loading_user_data("user_data.json");

              if ($user_data["current_page"] != 1) {
                $user_data["current_page"] = $user_data["current_page"] - 1;
              };
              
              reloading_cards("page");
              saving_user_data($user_data, "user_data.json");
            };

            function resume($path) {

              $last_watched_file = loading_user_data("last_watched_file.json");
              
              $user_data = loading_user_data("user_data.json");

              $last_watched_file = $last_watched_file[$path];

              $user_data["current_file"] = $last_watched_file;

              saving_user_data($user_data, "user_data.json");

              require "movie_or_audio.php";

              if (movie_or_audio($last_watched_file) == "movie") {
                reloading_cards("movie");
              }
              elseif (movie_or_audio($last_watched_file) == "audio") {
                reloading_cards("audio");
              };

              exit;
              
            };

            if (@$_GET["submit"] == "reload") { // The @ blends error messages at this line out
                
              // loads the cards if the page was reloaded

              $user_data = loading_user_data("user_data.json");

              loading_cards($user_data["current_directory"]);

              echo '<script>document.getElementById("page").innerHTML = ' . $user_data["current_page"] . '; console.log("display page");</script>';

              if ($user_data["max_pages"] <= $user_data["current_page"]) {
                echo '<script>document.getElementById("li_down").style.display = "none";</script>';
              };
            }

            elseif (isset($_GET["submit"])) {

                // variables

                $user_data = loading_user_data("user_data.json");

                $category = $_GET["category"];

                $path = $user_data["main_path"] . "/" . $category;

                $current_dir = $user_data["current_directory"]; // saves the current directory for comparing it with the new one

                // TODO Implementierung von Seiten und der resume Funktion

                switch ($category) {
                    case "filme":
                        $user_data["current_directory"] = $path;
                        $user_data["current_page"] = 1;
                        saving_user_data($user_data, "user_data.json");
                        loading_cards($path);
                        break;
                    case "serien":
                        $user_data["current_directory"] = $path;
                        $user_data["current_page"] = 1;
                        saving_user_data($user_data, "user_data.json");
                        loading_cards($path);
                        break;
                    case "hoerspiele":
                        $user_data["current_directory"] = $path;
                        $user_data["current_page"] = 1;
                        saving_user_data($user_data, "user_data.json");
                        loading_cards($path);
                        break;
                    case "puppen":
                        $user_data["current_directory"] = $path;
                        $user_data["current_page"] = 1;
                        saving_user_data($user_data, "user_data.json");
                        loading_cards($path);
                        break;
                    case "up":
                        page_up();
                        break;
                    case "down":
                        page_down();
                        break;                    
                    case "resume":
                        // Funktion ohne Parameter aufrufen - verwendet current_file aus user_data
                        resume($user_data["current_directory"]);
                        break;
                };

                // Updates the page display

                echo '<script>document.getElementById("page").innerHTML = ' . $user_data["current_page"] . '; console.log("display page");</script>';

                if ($user_data["max_pages"] <= $user_data["current_page"]) {
                  echo '<script>document.getElementById("li_down").style.display = "none";</script>';
                };
            }

            if (isset($_GET["cardDir"])) {

              $card_dir = $_GET["cardDir"];

              $user_data = loading_user_data("user_data.json");

              $user_data["current_page"] = 1;

              console_log($card_dir);

              loading_cards($card_dir);

              echo '<script>document.getElementById("page").innerHTML = ' . $user_data["current_page"] . '; console.log("display page");</script>';

              if ($user_data["max_pages"] <= $user_data["current_page"]) {
                echo '<script>document.getElementById("li_down").style.display = "none";</script>';
              };

            };
          ?>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              const currentPage = <?php echo loading_user_data("user_data.json")["current_page"]; ?>;
              const maxPages = <?php echo loading_user_data("user_data.json")["max_pages"]; ?>;

              if (currentPage <= 1) {
              document.getElementById("li_up").style.display = "none";
              }
              else {
                document.getElementById("li_up").style.display = "inline";
              }

              if (currentPage >= maxPages) {
              document.getElementById("li_down").style.display = "none";
              }
              else {
                document.getElementById("li_down").style.display = "inline";
              }
            });
          </script>

            
        </div>
      </div>
    </div>
  </div>
</body>
</html>