import requests
import os
from datetime import datetime
import time
import platform
def getData():
    while True:
        try:
            #  Récupérer IP publique
            ip_response = requests.get("https://api.ipify.org?format=json")
            public_ip = ip_response.json()["ip"]

            #  Récupérer localisation via IP
            geo_response = requests.get(f"http://ip-api.com/json/{public_ip}")
            geo_data = geo_response.json()

            country = geo_data.get("country")
            city = geo_data.get("city")
            lat = geo_data.get("lat")
            lon = geo_data.get("lon")
            #  Préparer données à envoyer vers Laravel
            payload = {
                "computer_name": os.environ['COMPUTERNAME'],
                "ip": public_ip,
                "country": country,
                "city": city,
                "latitude": lat,
                "longitude": lon,
                "status": "Disponible",
                "timestamp": datetime.now().isoformat()
            }
            print('Demarrage de authentification au serveur Laravel...')
            try:
                response = requests.post(
                "http://127.0.0.1:8000/api/ordinateurs",
                json=payload,
                headers={"Authorization": "Bearer TON_TOKEN_API"}
                )
                print(f"Status Code: {response.status_code}, Response: {response.text}, datetime {datetime.now().isoformat()}")
            except Exception as e:
                print(f"Erreur lors de l'envoi des données vers serveur: {e}")
                response = None
    
        except Exception as e:
            print(f"Erreur lors de la récupération des données ou de l'envoi")
            response = None
        time.sleep(10)
getData()