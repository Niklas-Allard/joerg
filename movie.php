<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="send_data_media_progress.js"></script>
</head>
<body>
    <style>
        body{
            background: black;
        }
    </style>

    <video autoplay id="movie" width="80%">
        
    </video>

    <!-- TODO Den Rahmen mit Navbar und Titel usw. hinzufügen.-->

    <?php
        require "transforming_user_data.php";
        $user_data = loading_user_data("user_data.json");
        $video_path = str_replace($user_data["main_path"], $user_data["path_link"], $user_data["current_file"]);

        $media_progress = loading_user_data("media_progress.json");

        if (isset($media_progress[$video_path])) {
            $current_time = $media_progress[$video_path];
        } else {
            $current_time = 0;
        }
    ?> 
 
    <script> 
    
        localStorage.setItem("videoPath", "assets/BIKINI PLANET - Ehrenmänner of the Galaxy 2 I Julien Bam.mp4")
    
        const movie = document.getElementById("movie");

        const src_element = '<source id="movie_source" type="video/mp4" src="' + "<?php echo $video_path; ?>" + '"/>'

        movie.innerHTML = src_element

        current_time = <?php echo $current_time; ?> // current time of the video
        
        if (current_time > 0 && current_time < movie.duration) {
            console.log("Current time" + movie.currentTime);
            movie.currentTime = current_time; // set the current time of the video
            console.log("Current time set to: " + current_time);

        }

        const movie_source_src = document.getElementById("movie_source").getAttribute("src") // src of video/source

        console.log(movie_source_src)
        
        // saving the path
        localStorage.setItem('videoPath', movie_source_src);

        // pausing and playing through an click
        movie.addEventListener("click", () => {
            console.log("event")

            if (movie.paused) {

                movie.play();
            }
            else {

                movie.pause()
            };

        });

        // checks if the video has ended
        movie.addEventListener('ended', () => {
            console.log('Das Video ist zu Ende.');
        });

        setInterval(() => {
            const current_time = movie.currentTime;
            const file_path = movie.querySelector('source').getAttribute('src');

            console.log("Current time: " + current_time);

            // Dynamically create an object where the key is the file_path
            const data = {};
            data[file_path] = current_time;

            // Send progress data to the server
            sendDataViaGet('getting_media_progress.php', data);
        }, 5000);
        
    </script>        
    <script src="no_context_menu.js"></script>
</body>
</html>