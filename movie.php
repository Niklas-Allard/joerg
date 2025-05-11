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
            background: white;
        }
    </style>

    <video autoplay id="movie" width="80%">
        
    </video>

    <!-- TODO Den Rahmen mit Navbar und Titel usw. hinzufügen.-->

    <?php
        require "transforming_user_data.php";
        $user_data = loading_user_data("user_data.json");
        $video_path = str_replace($user_data["main_path"], $user_data["path_link"], $user_data["current_file"]);

        $video_path = str_replace(".", "_", $video_path); 
        $video_path = str_replace(" ", "_", $video_path);
        $video_path = str_replace("/", "\/", $video_path);
        $video_path = str_replace("ä", "\u00e4", $video_path); 

        echo $video_path;

        $media_progress = loading_user_data("media_progress.json");

        $current_time = $media_progress[$video_path]; // current time of the video
        
        /*
        if (isset($media_progress[$video_path])) {
            $current_time = $media_progress[$video_path];
        } else {
            $current_time = 0;
        }*/

        $video_path = str_replace($user_data["main_path"], $user_data["path_link"], $user_data["current_file"]);
    ?> 
 
    <script> 
    
        const movie = document.getElementById("movie");

        const src_element = '<source id="movie_source" type="video/mp4" src="' + "<?php echo $video_path; ?>" + '"/>'

        movie.innerHTML = src_element

        const current_time = <?php echo $current_time; ?> // current time of the video

        // Setze die Startzeit des Videos (z. B. 30 Sekunden)
        movie.addEventListener("loadedmetadata", () => {
            movie.currentTime = current_time; // Setze die Startzeit auf 30 Sekunden
            console.log("Current time: " + current_time);
        });

        const movie_source_src = document.getElementById("movie_source").getAttribute("src") // src of video/source
        
        // saving the path
        localStorage.setItem('videoPath', movie_source_src);

        // pausing and playing through an click
        movie.addEventListener("click", () => {
            console.log("event")
            console.log(movie.duration)

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

            console.log(movie.duration)

            const current_time = movie.currentTime;

            const file_path = "<?php echo $video_path; ?>" // src of video/source

            console.log("Current time:s " + current_time);

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