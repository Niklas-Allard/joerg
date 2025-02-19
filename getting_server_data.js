function getting_server_data() {
    const eventSource = new EventSource('sending_data_to_client.php');

    eventSource.onmessage = (event) => {
    console.log("Nachricht vom Server:", event.data);
    };
}