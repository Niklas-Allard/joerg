function saving_storage(key, value) {
    // Speichern von Daten im LocalStorage
    localStorage.setItem(key, value);
};

function loading_storage(key) {
    // Lesen der Daten aus LocalStorage
    var username = localStorage.getItem(key);
    console.log(username);
}