document.addEventListener('contextmenu', (event) => {
    event.preventDefault(); // Verhindert das Standard-Kontextmenü
    console.log('Kontextmenü deaktiviert.');
});