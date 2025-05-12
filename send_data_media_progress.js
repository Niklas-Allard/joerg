// This function sends data to a PHP file using the POST method
function sendDataViaPOST(url, params) {
    // Create a new XMLHttpRequest
    const xhr = new XMLHttpRequest();

    // Open a POST request
    xhr.open("POST", url, true);

    // Set the Content-Type header for sending JSON data
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    // Set up a callback to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) { // Request is complete
            if (xhr.status === 200) { // Success
                console.log("Response received:", xhr.responseText);
            } else { // Error
                console.error("Error sending data:", xhr.statusText);
            }
        }
    };

    // Send the request with JSON stringified data
    xhr.send(JSON.stringify(params));
}

// Example usage:
// sendDataViaPOST('example.php', { "file_name": 'Seconds' });
