package main

import (
	"io"
	"log"
	"os"
)

func main() {
	src := "C:\\xampp\\htdocs\\joerg\\default_user_data.json"
	dst := "C:\\xampp\\htdocs\\joerg\\user_data.json"

	sourceFile, err := os.Open(src)
	if err != nil {
		log.Fatalf("Fehler beim Öffnen der Quelldatei: %v", err)
	}
	defer sourceFile.Close()

	destFile, err := os.Create(dst)
	if err != nil {
		log.Fatalf("Fehler beim Erstellen der Zieldatei: %v", err)
	}
	defer destFile.Close()

	_, err = io.Copy(destFile, sourceFile)
	if err != nil {
		log.Fatalf("Fehler beim Kopieren: %v", err)
	}

	log.Println("Datei erfolgreich kopiert.")
}
