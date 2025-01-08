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
        <source id="movie_source" src="assets/lv_0.mp4"/>
    </video>

    <!-- TODO Den Rahmen mit Navbar und Titel usw. hinzufügen.-->

    <script>

        // saving the path
        localStorage.setItem('videoPath', currentTime);

        // pausing and playing through an click
        const movie = document.getElementById("movie");

        movie.addEventListener("click", () => {

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
            const currentTime = movie.currentTime;
            localStorage.setItem('videoTime', currentTime);
            console.log(`Regelmäßig gespeicherte Zeit: ${currentTime} Sekunden`);
        }, 2000); // Alle 5 Sekunden

    </script>
    <script src="no_context_menu.js"></script>
</body>
</html>

<?php

function movie($directory) {

    

}

?>