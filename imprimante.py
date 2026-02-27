import socket
import requests
import datetime
import time
from pysnmp.hlapi import *
from concurrent.futures import ThreadPoolExecutor

# CONFIGURATION
NETWORK = "10.10.10."   # <-- change selon ton réseau
PORT = 9100
SNMP_COMMUNITY = "public"
TIMEOUT = 0.5

printers_found = []

def scan_ip(ip):
    try:
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.settimeout(TIMEOUT)
        result = s.connect_ex((ip, PORT))
        s.close()
        
        if result == 0:
            print(f"[+] Port 9100 ouvert sur {ip} - Vérification SNMP...")
            payload = {
                "ip": ip,
               }
          
        
            try:
                response = requests.post(
                "http://127.0.0.1:8000/api/imprimantesInventaire",
                json=payload,
                headers={"Authorization": "Posting Imprimante"}
                )
                print(f"Status Code: {response.status_code}, Response: {response.text}, datetime {datetime.now().isoformat()}")
            except:
                print("Erreur d'envoi des resultat")
            get_snmp_info(ip)
            

    except:
        pass


def get_snmp_info(ip):
    try:
        iterator = getCmd(
            SnmpEngine(),
            CommunityData(SNMP_COMMUNITY),
            UdpTransportTarget((ip, 161), timeout=1, retries=0),
            ContextData(),
            ObjectType(ObjectIdentity('1.3.6.1.2.1.1.1.0')),  # sysDescr
            ObjectType(ObjectIdentity('1.3.6.1.2.1.1.5.0'))   # sysName
        )

        errorIndication, errorStatus, errorIndex, varBinds = next(iterator)

        if not errorIndication and not errorStatus:
            model = varBinds[0][1]
            name = varBinds[1][1]

            printers_found.append({
                "ip": ip,
                "model": str(model),
                "name": str(name)
            })

            print(f"    🖨️ IMPRIMANTE DETECTÉE")
            print(f"    IP: {ip}")
            print(f"    Nom: {name}")
            print(f"    Modèle: {model}")
            print("-" * 50)

        else:
            print(f" SNMP non disponible sur {ip}")

    except:
        pass


def main():
    while True:
        print(" Scan réseau en cours...\n")

        with ThreadPoolExecutor(max_workers=50) as executor:
            for i in range(1, 255):
                ip = NETWORK + str(i)
                executor.submit(scan_ip, ip)
        print("\n Scan terminé.")
        print(f"\nTotal imprimantes détectées : {len(printers_found)}")

        time.sleep(10)


if __name__ == "__main__":
    main()