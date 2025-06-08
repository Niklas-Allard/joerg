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
        print(f"{file_name} wurde geloescht")


# Generierung der Text-To-Speach-Datei

with open("./communication.txt", mode = "r", encoding="utf-8") as file:
    input = file.read()

print(input)

message = ""

counter = 0

if input.find("(") != -1:

    counter = 0
    
    for letter in input:

        if letter == "(":
                counter +=1

        if counter == input.count("("):
            break

        message += letter

elif input.find(".") != -1:
    iterated_on_the_point = False

    for letter in reversed(input):

        if iterated_on_the_point == True:
            message += letter

        if letter == ".":
            iterated_on_the_point = True

    message = "".join(reversed(message))
    print(message)

else:
    message = input
    
if message != "":

    # Text-to-Speech-Engine initialisieren
    engine = pyttsx3.init()

    # Sprache einstellen (Deutsch in diesem Fall)
    engine.setProperty('voice', 'de')

    # Geschwindigkeit (optional)
    engine.setProperty('rate', 150)  # Standard: 200

    # Lautstärke (optional)
    engine.setProperty('volume', 1.0)  # Werte zwischen 0.0 und 1.0

    # Austauschen der Umlaute mit Unicode-Zeichen

    output_file_name = message # Dateiname für die WAV-Datei
    
    first_num = False
    allowed_number = "0123456789"

    output = ""

    for char in message:
        if char in allowed_number:
            if not first_num:
                if char == "0":
                    continue
                output += char
                first_num = True
            else:
                output += char
        else:
            output += char
            first_num = False

    message = output

    output_file_name = output_file_name.replace("ä", "ae")
    output_file_name = output_file_name.replace("ö", "oe")
    output_file_name = output_file_name.replace("ü", "ue")
    output_file_name = output_file_name.replace("Ä", "Ae")
    output_file_name = output_file_name.replace("Ö", "Oe")
    output_file_name = output_file_name.replace("Ü", "Ue")
    output_file_name = output_file_name.replace("ß", "ss")

    # Datei speichern (z. B. als WAV)
    output_file = f"output/{output_file_name}.wav"

    # Erstellung der Sprachausgabe und Entgültige Speicherung

    engine.save_to_file(message, output_file)

    # Warten, bis die Sprachausgabe abgeschlossen ist
    engine.runAndWait()

    print(output_file)

    # Aufrufen der response_to_website.py datei

    from response_to_website import response_to_website

    response_to_website("./tts/" + output_file)