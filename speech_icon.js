function speech_icon(info) {
    send_data(info);

    setTimeout(function() {
        document.createElement('audio').play().catch(function() {
            console.error('Audio playback failed. Ensure the audio file is accessible and the browser allows autoplay.');
        });
    }, 1000);
}