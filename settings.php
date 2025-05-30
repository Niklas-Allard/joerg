<?php
require "transforming_user_data.php";

$css = loading_user_data("css.json");

$navbar_width = $css["navbar_width"];
$navbar_color = $css["navbar_color"];
$icon_size = $css["icon_size"];
$cover_size = $css["cover_size"];
$main_container_color = $css["main_container_color"];
$content_color = $css["content_color"];
$title_size = $css["title_size"];


// Saving mechanic
if (isset($_GET["settings"])) {
    $navbar_width = $_GET["navbar_width"];
    $navbar_color = $_GET["navbar_color"];
    $icon_size = $_GET["icon_size"];
    $cover_size = $_GET["cover_size"];
    $main_container_color = $_GET["background_color"];
    $content_color = $_GET["content_color"];
    $title_size = $_GET["title_size"];

    $css["navbar_width"] = $navbar_width;
    $css["navbar_color"] = $navbar_color;
    $css["icon_size"] = $icon_size;
    $css["cover_size"] = $cover_size;
    $css["main_container_color"] = $main_container_color;
    $css["content_color"] = $content_color;
    $css["background_color"] = $main_container_color;
    $css["title_size"] = $title_size;

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

        <label for="navbar_width">Navbar Width:</label>
        <input type="text" id="navbar_width" name="navbar_width" value="<?php echo $navbar_width; ?>" step="5" required>
        <br><br>

        <label for="navbar_color">Navbar Color:</label>
        <input type="color" id="navbar_color" name="navbar_color" value="<?php echo $navbar_color; ?>" required>
        <br><br>

        <label for="icon_size">Icon Size:</label>
        <input type="text" id="icon_size" name="icon_size" value="<?php echo $icon_size; ?>" step="5" required> 
        <br><br>

        <label for="cover_size">Cover Size:</label>
        <input type="text" id="cover_size" name="cover_size" value="<?php echo $cover_size; ?>" step="5" required> 
        <br><br>

        <label for="background_color">Background Color:</label>
        <input type="color" id="background_color" name="background_color" value="<?php echo $background_color; ?>" required>
        <br><br>

        <label for="content_color">Content Color:</label>
        <input type="color" id="content_color" name="content_color" value="<?php echo $background_color; ?>" required>
        <br><br>

        <label for="title_size">Title Size:</label>
        <input type="text" id="title_size" name="title_size" value="<?php echo $title_size; ?>" required>
        <br><br>

        <input type="submit" name="settings" value="Save Settings">
    </form>

</body>
</html>