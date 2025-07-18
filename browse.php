<?php
require "transforming_user_data.php";

$css = loading_user_data("css.json");

$navbar_width = $css["navbar_width"];
$navbar_color = $css["navbar_color"];
$icon_size = $css["icon_size"];
$main_container_color = $css["main_container_color"];
$content_color = $css["content_color"];
$card_height = $css["card_height"];
$card_width = $css["card_width"];

$current_category_border_color = $css["current_category_border_color"];
$current_category_border_width = $css["current_category_border_width"];
$current_category_border_style = $css["current_category_border_style"];
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
  background-color: <?php echo $main_container_color; ?>;
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
  grid-template-columns: repeat(auto-fit, minmax(<?php echo $card_width ?>, 1fr)); /* Kleinere Karten mit flexibler Anzahl */
  gap: 15px; /* Geringerer Abstand zwischen den Karten */
  padding: 20px;
  border-radius: 8px;
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

.header-text:hover .info-box {
  display: block; /* Zeigt die Info-Box beim Hover */
}

.header-icon {
  font-size: 2rem;
  float: right;
}

.card {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 10px; /* Weniger Padding für kleinere Karten */
  text-align: center;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  height: <?php echo $card_height ?>; /* Fixierte Höhe für einheitliche Kartengröße */
  min-width: 5%;
  max-width: 400px; /*TODO max-width problem*/
  display: flex;
  flex-direction: column;
  cursor: pointer;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

.card h3 {
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
            <label for="filme"><svg id="icon_filme" width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="m160-800 80 160h120l-80-160h80l80 160h120l-80-160h80l80 160h120l-80-160h120q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800Zm0 240v320h640v-320H160Zm0 0v320-320Z"/></svg></label>
            <input type="hidden" name="category" value="filme">
            <button type="submit" id="filme" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
                
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get" id="form_serien">
            <label for="serien"><svg id="icon_serien" width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M320-320h480v-400H320v400Zm0 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z"/></svg></label>
            <input type="hidden" name="category" value="serien">
            <button type="submit" id="serien" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
              
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get" id="form_hoerspiele">
            <label for="audio"><svg id="icon_hoerspiele" width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M400-120q-66 0-113-47t-47-113q0-66 47-113t113-47q23 0 42.5 5.5T480-418v-422h240v160H560v400q0 66-47 113t-113 47Z"/></svg></label>
            <input type="hidden" name="category" value="hoerspiele">
            <button type="submit" id="audio" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
        
        <li>
          <!-- a single icon with an formulare -->
          <form action="browse.php" method="get" id ="form_puppen">
            <label for="puppen"><svg id="icon_puppen" width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg></label>
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
            <label for="resume"><svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $icon_size; ?>" viewBox="0 -960 960 960" fill="white"><path d="M240-240v-480h80v480h-80Zm160 0 400-240-400-240v480Zm80-141v-198l165 99-165 99Zm0-99Z"/></svg></label>
            <input type="hidden" name="category" value="resume">
            <button type="submit" id="resume" class="submit" name="submit" value="submit"></button>
          </form>               
        </li>
        <script>
          const page = document.getElementById("page").innerHTML;

          if (page == 1) {
            document.getElementById("li_up").style.visibility = "hidden";
          }
        </script>
      </ul>
    </div>

    <!-- Hauptcontainer links -->
    <div class="main-container">
      <!-- Bereich über dem Container -->
      <div class="header">
        <span class="header-icon">
          <svg xmlns="http://www.w3.org/2000/svg" height="2rem" viewBox="http://www.w3.org/2000/svg" fill="white"><path d="M560-160v-80h104L537-367l57-57 126 126v-102h80v240H560Zm-344 0-56-56 504-504H560v-80h240v240h-80v-104L216-160Zm151-377L160-744l56-56 207 207-56 56Z"/></svg>
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

              // highligthing the current category
              highlight_category($directory);
              
              // TODO Die Möglichkeit das Videos angezeigt werden muss implementiert werden

              require "log.php";

              console_log($directory);

              $allowed_file_types = loading_user_data("allowed_file_types.json");

              if (is_dir($directory)) {

                // Dateien und Ordner auslesen
                $items = scandir($directory);

                $items = array_diff($items, array('.', '..')); // filters the "." and ".." out

                $id = 0; // solves problems if an item has spaces in it
                
                $user_data = loading_user_data("user_data.json");

                $user_data["current_directory"] = $directory;

                saving_user_data($user_data, "user_data.json");
                
                $counter = 0; // for the page system | counts the carts

                foreach ($items as $item) {
                    // checking if it is a file and if it an allowed file type
                    if (is_file($item)) {
                        $item = str_replace(" ", "\\00a0", $item); // replaces the spaces with \00a0
                    }

                    // Nur Ordner anzeigen (ohne "." und "..")
                    if (is_dir($directory . "/" . $item) && $item !== ".wd_tv") {
                      
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

                        if ($counter >= ($user_data["elements_per_page"]) * ($user_data["current_page"])) { # sets the limit of the page
                          break;
                        }
                        elseif ($counter < ($user_data["elements_per_page"]) * ($user_data["current_page"] - 1)) { # skips the elements of the previous page
                          continue;
                        };
                        
                        $id = $id + 1; 

                        $item_img_path = $item;

                        $suffix_img_path = "ico";

                        if (str_ends_with($item, "!")) {
                          $item_img_path = substr($item, 0, -1); // removes the ! at the end of the item
                        }

                        console_log("!!!!!!" . $item_img_path); 
                        console_log('img/' . $item_img_path . '.ico'); // background-size: cover; background-position: center;

                        $allowed_file_types = loading_user_data("allowed_file_types.json");

                        foreach ($allowed_file_types["img"] as $type) {
                          if (is_file("img/" . $item_img_path . "." . $type)) {
                            $suffix_img_path = $type;
                          }
                        }

                        if ($user_data["show_title"] == false) {
                          $title = "";
                        } else {
                          $title = htmlspecialchars($item);
                        }

                        echo '
                        <div class="card" id="'. $item . '" style="background-image: url(\'img/' . rawurlencode($item_img_path) . "." . rawurlencode($suffix_img_path) . '\'); background-size: cover; background-position: center;">
                            
                            <h3>' . $title . '</h3>
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
                                } else {
                                    newItem' . $id . ' = item' . $id . ';
                                }

                                console.log(newItem' . $id . ');

                                item' . $id . ' = newItem' . $id . ';


                                item' . $id . ' = item' . $id . '.replace(/ö/g, "oe");
                                item' . $id . ' = item' . $id . '.replace(/ä/g, "ae");
                                item' . $id . ' = item' . $id . '.replace(/ü/g, "ue");
                                item' . $id . ' = item' . $id . '.replace(/Ö/g, "Oe");
                                item' . $id . ' = item' . $id . '.replace(/Ä/g, "Ae");
                                item' . $id . ' = item' . $id . '.replace(/Ü/g, "Ue");
                                item' . $id . ' = item' . $id . '.replace(/ß/g, "ss");

                                
                                const audio_content' . $id . ' = "<audio id=\"audio_element\">" + 
                                  "<source src=\"tts/output/" + item' . $id . ' + ".wav\" type=\"audio/wav\" id=\"audio_src\"/>" + 
                                "</audio>";

                                audio_div.innerHTML = audio_content' . $id . ';

                                document.getElementById("audio_element").play();

                                bigCard' . $id . '.style.display = "block";
                                bigCard' . $id . '.style.width = "50%";
                                bigCard' . $id . '.style.height = "50%";
                                console.log("bigCard visible");

                                const bigCardHTML = \'<img src="img/' . rawurlencode($item_img_path) . "." . $suffix_img_path . '" alt="Fehler beim Laden des Bildes">\';

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

                      $counter++;
                      
                      $id = $id + 1; 

                      if ($counter >= ($user_data["elements_per_page"]) * ($user_data["current_page"])) { # sets the limit of the page
                        break;
                      }
                      elseif ($counter < ($user_data["elements_per_page"]) * ($user_data["current_page"] - 1)) { # skips the elements of the previous page
                        continue;
                      };

                      // image path
                      $cover_path = $item;

                      $path = pathinfo($cover_path, PATHINFO_FILENAME);

                      console_log("Path: " . $path);
                      
                      $all_img_ends = loading_user_data("allowed_file_types.json")["img"];

                      $found_exact_file_img = false; // Variable to check if an exact file image is found
                      $found_dir_file_img = false; // Variable to check if a directory file image is found#

                      foreach ($all_img_ends as $img_end) {
                          if (is_file("img/" . urldecode($path) . "."  . $img_end)) {
                              $cover_path = "img/" . $path . "." . $img_end;
                              $found_exact_file_img = true; // Set to true if an exact file image is found
                              break;
                          }
                      }

                      if (!$found_exact_file_img) {
                        $cover_path = $directory;

                        $seperated_path = explode("/", $cover_path);

                        console_log(json_encode($all_img_ends));

                        $path = $seperated_path[count($seperated_path) - 1];

                        if (str_ends_with($path, "!")) {
                          $path = substr($path, 0, -1); // removes the ! at the end of the path
                        }

                        console_log("Path_dir: " . $path);

                        foreach ($all_img_ends as $img_end) {
                          console_log("Checking for directory file image: img/" . $path . "." . $img_end);
                          if (is_file("img/" . $path . "." . $img_end)) {
                              $cover_path = "img/" . $path . "." . $img_end;
                              $found_dir_file_img = true; // Set to true if a directory file image is found
                              break;
                          }
                        }
                      }

                      if (!$found_dir_file_img && !$found_exact_file_img) {
                        console_log("No image found for: " . $item);
                      }

                      if ($user_data["show_title"] == false) {
                        $title = "";
                      } else {
                        $title = htmlspecialchars($item);
                      }
                      
                      echo '
                      <div class="card" id="'. $item . '" style="background-image: url(\'' . $cover_path . '\'); background-size: cover; background-position: center;">
                            
                            <h3>' . $title . '</h3>
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


                                item' . $id . ' = item' . $id . '.replace(/ö/g, "oe");
                                item' . $id . ' = item' . $id . '.replace(/ä/g, "ae");
                                item' . $id . ' = item' . $id . '.replace(/ü/g, "ue");
                                item' . $id . ' = item' . $id . '.replace(/Ö/g, "Oe");
                                item' . $id . ' = item' . $id . '.replace(/Ä/g, "Ae");
                                item' . $id . ' = item' . $id . '.replace(/Ü/g, "Ue");
                                item' . $id . ' = item' . $id . '.replace(/ß/g, "ss");

                                
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
                  echo '<script>document.getElementById("li_down").style.visibility = "hidden";</script>';
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
                  $last_watched_file[$key] = $directory;

                  $key = "";
                }

                saving_user_data($last_watched_file, "last_watched_file.json");

                // saving the last fil & the page in user_data.json
                
                $user_data["current_file"] = $directory;

                $user_data["last_page"] = $user_data["current_page"];

                saving_user_data($user_data, "user_data.json");
                
                $user_data["current_page"] = 1; // resets the page to 1 if a file was opened

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

            function highlight_category($directory) {
              
              global $current_category_border_color;
              global $current_category_border_width; 
              global $current_category_border_style;

              $category = null;              
              switch ($directory) {
                case str_contains($directory, "filme"):
                  $category = "filme";
                  break;
                case str_contains($directory, "serien"):
                  $category = "serien";
                  break;
                case str_contains($directory, "hoerspiele"):
                  $category = "hoerspiele";
                  break;
                case str_contains($directory, "puppen"):
                  $category = "puppen";
                  break;
              };
    
              if ($category !== null) {
                echo '
                  <style> 
                    #icon_' . $category . ' {
                      border-color: ' . $current_category_border_color . ';
                      border-size: ' . $current_category_border_width . ';
                      border-style: ' . $current_category_border_style . ';
                    }
                  </style>
                ';
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

              $directory = $user_data["current_directory"];

              switch ($directory) {
                case str_ends_with($directory, "filme"):
                  $category = "filme";
                  break;
                case str_ends_with($directory, "serien"):
                  $category = "serien";
                  break;
                case str_ends_with($directory, "hoerspiele"):
                  $category = "hoerspiele";
                  break;
                case str_ends_with($directory, "puppen"):
                  $category = "puppen";
                  break;
                default:
                  $category = null;
              };

              $user_data["current_page"] = $user_data["current_page"] + 1;

              if ($category !== null) {
                $user_data["category_pages"][$category] = $user_data["current_page"];
              }

              reloading_cards("page");
              saving_user_data($user_data, "user_data.json");
            };

            function page_up() {
              $user_data = loading_user_data("user_data.json");

              $directory = $user_data["current_directory"];

              switch ($directory) {
                case str_contains($directory, "filme"):
                  $category = "filme";
                  break;
                case str_contains($directory, "serien"):
                  $category = "serien";
                  break;
                case str_contains($directory, "hoerspiele"):
                  $category = "hoerspiele";
                  break;
                case str_contains($directory, "puppen"):
                  $category = "puppen";
                  break;
                default:
                  $category = null;
              };

              if ($user_data["current_page"] != 1) {
                $user_data["current_page"] = $user_data["current_page"] - 1;

                if ($category !== null) {
                  $user_data["category_pages"][$category] = $user_data["current_page"];
                }
              };
              
              reloading_cards("page");
              saving_user_data($user_data, "user_data.json");
            };

            function back_to_previous_directory($url) {
              $decoded_url = rawurldecode($url);

              $seperated_url = explode("/", $decoded_url);

              $category = null; // saves the category of the current directory
              
              // if the previous directory is one of the categories
              if (count($seperated_url) !== 2) {
                switch ($seperated_url[1]) {
                  case "filme":
                    $category = "filme";
                    break;
                  case "serien":
                    $category = "serien";
                    break;
                  case "hoerspiele":
                    $category = "hoerspiele";
                    break;
                  case "puppen":
                    $category = "puppen";
                    break;
                }
              } else {
                # removes the last element of the array
                array_pop($seperated_url);

                # convert array into a string
                $path = implode("/", $seperated_url);
              }

              if ($category == null) {
                header("Location: browse.php?card_dir=" . $path);
              } else {
                header("Location: browse.php?category=" . $category . "&submit=submit");
              }

              exit;
            }

            function resume($path) {

              $last_watched_file = loading_user_data("last_watched_file.json");
              
              $user_data = loading_user_data("user_data.json");

              if (isset($last_watched_file[$path])) {
                
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
              } else {
                echo "
                  <script>
                    var audio = new Audio('feedback/feedback_resume_browse.wav');
                    audio.play();
                    
                    resume = 'resume';
                  </script>";
              };
              
            };

            if (@$_GET["submit"] == "reload") { // The @ blends error messages at this line out
                
              // loads the cards if the page was reloaded

              $user_data = loading_user_data("user_data.json");

              loading_cards($user_data["current_directory"]);

              echo '<script>document.getElementById("page").innerHTML = ' . $user_data["current_page"] . '; console.log("display page");</script>';

              if ($user_data["max_pages"] <= $user_data["current_page"]) {
                echo '<script>document.getElementById("li_down").style.visibility = "hidden";</script>';
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
                        $user_data["current_page"] = $user_data["category_pages"]["filme"];
                        saving_user_data($user_data, "user_data.json");
                        loading_cards($path);
                        break;
                    case "serien":
                        $user_data["current_directory"] = $path;
                        $user_data["current_page"] = $user_data["category_pages"]["serien"];
                        saving_user_data($user_data, "user_data.json");
                        loading_cards($path);
                        break;
                    case "hoerspiele":
                        $user_data["current_directory"] = $path;
                        $user_data["current_page"] = $user_data["category_pages"]["hoerspiele"];
                        saving_user_data($user_data, "user_data.json");
                        loading_cards($path);
                        break;
                    case "puppen":
                        $user_data["current_directory"] = $path;
                        $user_data["current_page"] = $user_data["category_pages"]["puppen"];
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
                  echo '<script>document.getElementById("li_down").style.visibility = "hidden";</script>';
                };
            }

            if (isset($_GET["cardDir"])) {

              $card_dir = $_GET["cardDir"];

              $user_data = loading_user_data("user_data.json");
              
              $user_data["current_page"] = 1;

              if (isset($_GET["back"])) {
                if ($_GET["back"] == "true") {
                  $user_data["current_page"] = $user_data["last_page"];
                  $user_data["last_page"] = null; // resets the last page to 1 if the user goes backs
                }
              }

              saving_user_data($user_data, "user_data.json");

              console_log($card_dir);

              loading_cards($card_dir);

              echo '<script>document.getElementById("page").innerHTML = ' . $user_data["current_page"] . '; console.log("display page");</script>';

              if ($user_data["max_pages"] <= $user_data["current_page"]) {
                echo '<script>document.getElementById("li_down").style.visibility = "hidden";</script>';
              };

            };
          ?>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              const currentPage = <?php echo loading_user_data("user_data.json")["current_page"]; ?>;
              const maxPages = <?php echo loading_user_data("user_data.json")["max_pages"]; ?>;

              if (currentPage <= 1) {
              document.getElementById("li_up").style.visibility = "hidden";
              }
              else {
                document.getElementById("li_up").style.visibility = "visible";
              }

              if (currentPage >= maxPages) {
              document.getElementById("li_down").style.visibility = "hidden";
              }
              else {
                document.getElementById("li_down").style.visibility = "visible";
              }
            });
          </script>

            
        </div>
      </div>
    </div>
  </div>
</body>
</html>