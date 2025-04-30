<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
 
    <script> 

        localStorage.setItem("videoPath", "assets/BIKINI PLANET - Ehrenmänner of the Galaxy 2 I Julien Bam.mp4")
    
        const movie = document.getElementById("movie");

        const src_element = '<source id="movie_source" src="' + "<?php require "transforming_user_data.php"; $user_data = loading_user_data("user_data.json"); echo $user_data["current_file"] ?>" + '"/>'

        movie.innerHTML = src_element

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

        // automatical saving of the videos current time
        setInterval(() => {
            // save current time
            const currentTime = movie.currentTime;
            console.log(currentTime)
            localStorage.setItem('videoTime', currentTime);
        }, 5000); // Alle 5 Sekunden
        
    </script>

    <script defer>
        localStorage.setItem('last_watched_video', localStorage.getItem("videoPath"));

        let path = localStorage.getItem("videoPath");

        if (path) {
            let text = "Hallo Welt";
            let pos = text.indexOf("Welt"); // 6
        }
    </script>
        
    <script src="no_context_menu.js"></script>
</body>
</html>

<?php

function movie($directory) {

    

}

?>