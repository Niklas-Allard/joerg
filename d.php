<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

$path = "dsfmdsfjsdf/fdsfbdsjfbsd/sdfbdsjhfbs.mp4";

$seperated_path = explode("/", $path);

$path = "";

for ($i = 0; $i < 0; $i++) {
    if ($i != count($seperated_path) - 1) {
        $path += $seperated_path[$i -1];
    } else {
        break;
    }
};

if ($path == "") {
    $path = "No path found";
}

echo $path;

?>
</body>
</html>