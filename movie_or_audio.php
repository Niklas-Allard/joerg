<?php

function movie_or_audio($item) { // TODO turn into 
    
    $all_movie_ends = array(".mp4", ".mkv", ".avs");

    $all_audio_ends = array(".mp3", ".wav");

    foreach ($all_movie_ends as $movie_end) {

        if (strpos($item, $movie_end)) {

            return "movie";
        };

    };

    foreach ($all_audio_ends as $audio_end) {

        if (strpos($item, $audio_end)) {

            return "audio";
        };

    };
};
?>