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

    <video autoplay id="movie" width="80%"></video>

    <input type="range" id="video-progress-range" min="0" max="100" value="0" step="0.001" style="width:80%;margin:20px auto;display:block;">
    <!-- Vollbild-Button entfernt -->

    <!-- TODO Den Rahmen mit Navbar und Titel usw. hinzufügen.-->

    <?php
        require "transforming_user_data.php";
        $user_data = loading_user_data("user_data.json");
        $video_path = str_replace($user_data["main_path"], $user_data["path_link"], $user_data["current_file"]);

        $media_progress = loading_user_data("media_progress.json");

        $current_time = $media_progress[$video_path]; // current time of the video

        if (!is_float($current_time)) {
            $current_time = 0;
        }

        $video_path = str_replace($user_data["main_path"], $user_data["path_link"], $user_data["current_file"]);
    ?> 
 
    <script> 
    
        const movie = document.getElementById("movie");
        const progressRange = document.getElementById("video-progress-range");

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
            sendDataViaPOST('getting_media_progress.php', data);
        }, 5000);

        // === Synchronisation Range <-> Video ===
        // Aktualisiere den Range-Input, wenn das Video abspielt
        movie.addEventListener('timeupdate', () => {
            if (!movie.duration) return;
            progressRange.value = (movie.currentTime / movie.duration) * 100;
        });

        // Wenn der User den Range-Input bewegt, Videozeit anpassen
        progressRange.addEventListener('input', (e) => {
            if (!movie.duration) return;
            const percent = parseFloat(progressRange.value) / 100;
            movie.currentTime = percent * movie.duration;
        });

        // Klick auf beliebige Stelle im Range-Input setzt die Zeit
        progressRange.addEventListener('mousedown', (e) => {
            progressRange.isSeeking = true;
        });
        progressRange.addEventListener('mouseup', (e) => {
            progressRange.isSeeking = false;
        });
        // Optional: Touch Events für mobile Geräte
        progressRange.addEventListener('touchstart', (e) => {
            progressRange.isSeeking = true;
        });
        progressRange.addEventListener('touchend', (e) => {
            progressRange.isSeeking = false;
        });

        // === Vollbild beim Abspielen, aber nicht beim Pausieren ===
        function triggerFullscreen() {
            if (document.fullscreenElement) return; // Bereits im Vollbild
            if (movie.requestFullscreen) {
                movie.requestFullscreen();
            } else if (movie.webkitRequestFullscreen) {
                movie.webkitRequestFullscreen();
            } else if (movie.msRequestFullscreen) {
                movie.msRequestFullscreen();
            }
        }

        movie.addEventListener('play', () => {
            triggerFullscreen();
        });
        movie.addEventListener('pause', () => {
            if (document.fullscreenElement && document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitFullscreenElement && document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msFullscreenElement && document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        });
        
    </script>        
    <script src="no_context_menu.js"></script>
</body>
</html>