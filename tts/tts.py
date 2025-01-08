import os 
import pyttsx3
from pathlib import Path 
os.chdir(Path(__file__).parent)


# Löschung alles Datein in dem Output-Folder
folder = "./output"

for file_name in os.listdir(folder):
    file_path = os.path.join(folder, file_name)
    if os.path.isfile(file_path): # Keine Ordner werden gelöscht
        os.remove(file_path)
        print(f"{file_name} wurde geloescht") # TODO den Output in der Konsole des Users sichtbar machen


# Generierung der Text-To-Speach-Datei

with open("./communication.txt", mode = "r") as file:
    input = file.read()

message = ""

for letter in input:

    if letter == "(":
        break

    message += letter


if message != "":

    # Text-to-Speech-Engine initialisieren
    engine = pyttsx3.init()

    # Sprache einstellen (Deutsch in diesem Fall)
    engine.setProperty('voice', 'de')

    # Geschwindigkeit (optional)
    engine.setProperty('rate', 150)  # Standard: 200

    # Lautstärke (optional)
    engine.setProperty('volume', 1.0)  # Werte zwischen 0.0 und 1.0

    # Datei speichern (z. B. als WAV)
    output_file = f"./output/{message}.wav"
    engine.save_to_file(message, output_file)

    # Warten, bis die Sprachausgabe abgeschlossen ist
    engine.runAndWait()

    print(output_file)

    # Aufrufen der response_to_website.py datei

    from response_to_website import response_to_website

    response_to_website(output_file)