<?php

require "transforming_user_data.php";

$item = "D:\serien\Alf\ALF - Folge 01 - Hallo, da bin ich.mp4";
$directory = "D:\serien\Alf";

$cover_path = $item;

$path = pathinfo($cover_path, PATHINFO_FILENAME);

echo "Path: " . $path;

$all_img_ends = loading_user_data("allowed_file_types.json")["img"];

$found_exact_file_img = false; // Variable to check if an exact file image is found
$found_dir_file_img = false; // Variable to check if a directory file image is found

foreach ($all_img_ends as $img_end) {
    echo "Checking for exact file image: img/" . urldecode($path) . "." . $img_end;
    if (is_file("img/" . urldecode($path) . "." . $img_end)) {
        $cover_path = "img/" . $path . $img_end;
        $found_exact_file_img = true; // Set to true if an exact file image is found
        break;
    }
}

if (!$found_exact_file_img) {
    $cover_path = $directory;

    $seperated_path = explode("/", $cover_path);

    echo json_encode($all_img_ends);

    $path = $seperated_path[count($seperated_path) - 1];

    echo "Path_dir: " . $path;

    foreach ($all_img_ends as $img_end) {
        echo "Checking for directory file image: img/" . $path . "." . $img_end;
        if (is_file("img/" . $path . "." . $img_end)) {
            $cover_path = "img/" . $path . "." . $img_end;
            $found_dir_file_img = true; // Set to true if a directory file image is found
            break;
        }
    }
}

if (!$found_dir_file_img && !$found_exact_file_img) {
    echo "No image found for: " . $item;
}