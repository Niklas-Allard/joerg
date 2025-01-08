function send_data(data) {

    // Fetch-Anfrage
    fetch('get_data.php', {
        method: 'POST', // HTTP-Methode (z. B. POST oder PUT)
        headers: {
            'Content-Type': 'text/plain' // Content-Type für einfache Strings
        },
        body: data // Der zu sendende String
    })
    .then(response => response.text()) // Serverantwort lesen
    .then(serverResponse => {
        return serverResponse;
    })
    .catch(error => {
        console.error("Fehler bei der Anfrage:", error);
    });

}