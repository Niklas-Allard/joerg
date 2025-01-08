function deleteCookie(name) {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

function getCookie(name) {
    // Alle Cookies abrufen und aufteilen
    const cookies = document.cookie.split('; ');
    
    // Jeden Cookie durchsuchen
    for (let cookie of cookies) {
        const [key, value] = cookie.split('='); // Name und Wert trennen
        if (key === name) {
            return value; // Wert zurückgeben, falls gefunden
        }
    }
    return null; // Cookie wurde nicht gefunden
}

function audio_play(src) {
    // Audio-Element erstellen

    let audio = document.createElement("audio");

    // Audio-Element konfigurieren

    audio.src = src;
    audio.id = "audio";
    audio.autoplay = true;
}

function audio_stop() {
    // Audio-Element enfernen

    let audio = document.getElementById("audio");

    audio.remove();
}