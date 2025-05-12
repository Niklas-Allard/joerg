<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Player</title>
    <script src="send_data_media_progress.js"></script>
</head>
<body>
    <style>
        body {
            background: black;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        #audio-icon {
            width: 200px;
            height: 200px;
            background: url('icons/audio.svg') no-repeat center center;
            background-size: contain;
            cursor: pointer;
        }
    </style>

    <div id="audio-icon"></div>
    <audio id="audio" autoplay src="<?php require "transforming_user_data.php"; $user_data = loading_user_data("user_data.json"); $audio_path = str_replace($user_data["main_path"], $user_data["path_link"], $user_data["current_file"]); echo $audio_path; ?>"></audio>
    
    <?php
        $media_progress = loading_user_data("media_progress.json");
        $current_time = $media_progress[$audio_path]; // current time of the audio
    ?>

    <script>
        const audio = document.getElementById("audio");
        const audioIcon = document.getElementById("audio-icon");

        // Play or pause audio on icon click
        audioIcon.addEventListener("click", () => {
            if (audio.paused) {
                audio.play();
            } else {
                audio.pause();
            }
        });

        audio.addEventListener('loadedmetadata', () => {
            audio.currentTime = <?php echo $current_time; ?>; //Set the start time
            console.log('Current time: ' + <?php echo $current_time; ?>);
        });

        // Log audio state changes
        audio.addEventListener("play", () => {
            console.log("Audio is playing");
        });

        audio.addEventListener("pause", () => {
            console.log("Audio is paused");
        });

        // Send progress data to the server periodically
        setInterval(() => {
            const current_time = audio.currentTime;
            const file_path = audio.getAttribute('src');

            // Dynamically create an object where the key is the file_path
            const data = {};
            data[file_path] = current_time;

            // Send progress data to the server
            sendDataViaPOST('getting_media_progress.php', data);
        }, 5000);

    </script>
</body>
</html>
