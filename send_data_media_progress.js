// This function sends data to a PHP file using the GET method
function sendDataViaGet(url, params) {
    // Construct the query string from the params object
    const queryString = new URLSearchParams(params).toString();

    // Create a new XMLHttpRequest
    const xhr = new XMLHttpRequest();

    // Open a GET request with the constructed URL
    xhr.open("GET", `${url}?${queryString}`, true);

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

    // Send the request
    xhr.send();
}

// Example usage:
// sendDataViaGet('example.php', { "file_name": 'Seconds'});
