import json

def load_json(path):
    """
    Lädt eine JSON-Datei vom angegebenen Pfad und gibt das dekodierte Python-Objekt zurück.
    :param path: Pfad zur JSON-Datei
    :return: Dekodierter JSON-Inhalt (meist dict oder list)
    """
    with open(path, 'r', encoding='utf-8') as f:
        return json.load(f)