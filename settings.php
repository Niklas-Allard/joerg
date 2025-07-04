<?php
require "transforming_user_data.php";

$css = loading_user_data("css.json");

$navbar_width = $css["navbar_width"];
$navbar_color = $css["navbar_color"];
$icon_size = $css["icon_size"];
$cover_size = $css["cover_size"];
$main_container_color = $css["main_container_color"];
$content_color = $css["content_color"];
$card_height = $css["card_height"];
$card_width = $css["card_width"];

$current_category_border_color = $css["current_category_border_color"];
$current_category_border_width = $css["current_category_border_width"];
$current_category_border_style = $css["current_category_border_style"];

// Saving mechanic
if (isset($_GET["settings"])) {
    $navbar_width = $_GET["navbar_width"];
    $navbar_color = $_GET["navbar_color"];
    $icon_size = $_GET["icon_size"];
    $cover_size = $_GET["cover_size"];
    $main_container_color = $_GET["background_color"];
    $content_color = $_GET["content_color"];
    $card_height = $_GET["card_height"];
    $card_width = $_GET["card_width"];
    $current_category_border_color = $_GET["current_category_border_color"];
    $current_category_border_width = $_GET["current_category_border_width"];
    $current_category_border_style = $_GET["current_category_border_style"];

    $css["navbar_width"] = $navbar_width;
    $css["navbar_color"] = $navbar_color;
    $css["icon_size"] = $icon_size;
    $css["cover_size"] = $cover_size;
    $css["main_container_color"] = $main_container_color;
    $css["content_color"] = $content_color;
    $css["card_height"] = $card_height;
    $css["card_width"] = $card_width;

    $css["current_category_border_color"] = $current_category_border_color;
    $css["current_category_border_width"] = $current_category_border_width;
    $css["current_category_border_style"] = $current_category_border_style;

    saving_user_data($css, "css.json");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>CSS Eigenschaften</h1>

    <form action="settings.php" method="get">

        <br>

        <label for="navbar_width">Navbar Width:</label>
        <input type="text" id="navbar_width" name="navbar_width" value="<?php echo $navbar_width; ?>" step="5" required>
        <p>Definiert die Weite der Navigationsleiste auf der linken Seite bei fast allen Seiten</p>
        <br><br>

        <label for="navbar_color">Navbar Color:</label>
        <input type="color" id="navbar_color" name="navbar_color" value="<?php echo $navbar_color; ?>" required>
        <p>Definiert die Farbe der Navigationsleiste auf der linken Seite</p>
        <br><br>

        <label for="icon_size">Icon Size:</label>
        <input type="text" id="icon_size" name="icon_size" value="<?php echo $icon_size; ?>" step="5" required> 
        <p>Definiert die Weite und Höhe des Icons</p>
        <br><br>

        <label for="cover_size">Cover Size:</label>
        <input type="text" id="cover_size" name="cover_size" value="<?php echo $cover_size; ?>" step="5" required> 
        <p>Definiert die Covergröße auf der audio.php Seite also wo man die Audio abspielen kann</p>
        <br><br>

        <label for="main_container_color">Main Container:</label>
        <input type="color" id="main_container_color" name="main_container_color" value="<?php echo $main_container_color; ?>" required>
        <p>Definiert die Farbe des Hintergrundes auf browse.php also der Seite mit den ganzen Karten</p>
        <br><br>

        <label for="content_color">Content Color:</label>
        <input type="color" id="content_color" name="content_color" value="<?php echo $background_color; ?>" required>
        <p>Definiert die Farbe des Hintergrundes rund um den Container der Karten in browse.php also der Seite mit den Karten</p>
        <br><br>

        <label for="card_height">Card Height:</label>
        <input type="text" id="card_height" name="card_height" value="<?php echo $card_height; ?>" required>
        <p>Definiert die Höhe der Karten in browse.php also der Seite mit den Karten</p>
        <br><br>

        <label for="card_width">Card Width:</label>
        <input type="text" id="card_width" name="card_width" value="<?php echo $card_width; ?>" required>
        <p>Definiert die Weite der Karten in browse.php also der Seite mit den Karten</p>
        <br><br>

        <label for="current_category_border_color">Current Category Border Color:</label>
        <input type="color" id="current_category_border_color" name="current_category_border_color" value="<?php echo $current_category_border_color; ?>" required>
        <p>Definiert die Farbe des Rahmens um das Category Icon (z.B. filme, serien, hoerspiele, puppen), der in browse.php zu finden ist</p>
        <br><br>

        <label for="current_category_border_width">Current Category Border Width:</label>
        <input type="text" id="current_category_border_width" name="current_category_border_width" value="<?php echo $current_category_border_width; ?>" required>
        <p>Definiert die Weite des Rahmens um das Category Icon (z.B. filme, serien, hoerspiele, puppen), der in browse.php zu finden ist</p>
        <br><br>

        <label for="current_category_border_style">Current Category Border Style:</label>
        <input type="text" id="current_category_border_style" name="current_category_border_style" value="<?php echo $current_category_border_style; ?>" required>
        <p>Definiert den Style (z.B. solid, dotted, dashed, usw.) der Karten in browse.php also der Seite mit den Karten</p>
        <br><br>

        <input type="submit" name="settings" value="Save Settings">
    </form>

</body>
</html>