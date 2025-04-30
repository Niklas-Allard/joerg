<?php

function movie_or_audio($path) {
    
    $all_movie_ends = array(".mp4", ".mkv", ".avs");

    $all_audio_ends = array(".mp3", ".wav");

    $items = scandir($path);

    foreach ($items as $item) {

        foreach ($all_movie_ends as $movie_end) {

            if (strpos($item, $movie_end)) {

                return $file = "movie";
            };

        };

        foreach ($all_audio_ends as $audio_end) {

            if (strpos($item, $audio_end)) {

                return $file = "audio";
            };

        };

    };

    return $file = "dir";

};
?>