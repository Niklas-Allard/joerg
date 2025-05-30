<?php

function movie_or_audio($item) { // TODO turn into 
    $file_types = loading_user_data("allowed_file_types.json");
    
    $all_movie_ends = $file_types["movie"];

    $all_audio_ends = $file_types["audio"];

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