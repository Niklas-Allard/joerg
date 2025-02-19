def response_to_website(msg):

    print

    import subprocess

    # Pfad zur PHP-Datei
    php_file = "./sending_data_to_client.php.php"

    import os

    # Führt den Befehl `ls` aus
    exit_code = os.system(f"php ../cookies.php {msg}")
    # print(f"Exit-Code: {exit_code}")

    # Nachricht an das PHP-Skript übergeben

    with open("cookies_message.txt", "w") as file:
        file.write(msg)

"""    # PHP-Skript ausführen
    try:
        result = subprocess.run(
            ["php", php_file, msg],
            capture_output=True,  # Um Ausgabe zu erhalten
            text=True             # Ausgabe als String
        )
        # Ausgabe anzeigen
        print("Ausgabe:", result.stdout)
        print("Fehler:", result.stderr)
    except FileNotFoundError:

        print("PHP ist nicht installiert oder im PATH nicht verfügbar.")
    except Exception as e:
        print(f"Ein Fehler ist aufgetreten: {e}")"""