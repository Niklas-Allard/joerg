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
        <source id="movie_source" src="assets/BIKINI PLANET - Ehrenmänner of the Galaxy 2 I Julien Bam.mp4"/>
    </video>

    <p id="time" style="color: white"></p>

    <!-- TODO Den Rahmen mit Navbar und Titel usw. hinzufügen.-->

    <script>
        
        const movie_source_src = document.getElementById("movie_source").getAttribute("src")

        console.log(movie_source_src)

        // saving the path
        localStorage.setItem('videoPath', movie_source_src);

        // pausing and playing through an click
        const movie = document.getElementById("movie");

        movie.addEventListener("click", () => {
            console.log("event")

            if (movie.paused) {

                movie.play();
            }
            else {

                movie.pause()
            };

        });

        // Display time

        const time_text = document.getElementById("time")

        time_text.innerText = movie.currentTime

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
        
    <script>
        while (true) {
            // Display time

            const time_text = document.getElementById("time")

            time_text.innerText = Math.floor(movie.currentTime)
        }
    </script>
    <script src="no_context_menu.js"></script>
</body>
</html>

<?php

function movie($directory) {

    

}

?>