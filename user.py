from faker import Faker
from datetime import date , timedelta
import random
import string
import csv
import os


# Write data to a CSV file
filename = "faker_data.csv"
# Initialiser l'objet Faker
fake = Faker('fr_FR')

# Générer des enregistrements d'utilisateurs fictifs
users = []
services = ["esthetique dentaire" ,"Facettes dentaires","Implants dentaires",
            "Protheses dentaires","Blanchiment dentaire","hollywood smile"] 
for _ in range(3):  # Générer 10 utilisateurs
    deux_premieres_lettres = random.choices(string.ascii_uppercase, k=2)
    six_derniers_nombres = random.choices(string.digits, k=6)
    date =  date.today() + timedelta(days=random.randint(1, 365))
    phone_number = fake.phone_number()
    user = {
        'CIN': ''.join(deux_premieres_lettres + six_derniers_nombres),
        'First_Name': fake.first_name(),
        'Last_Name': fake.last_name(),
        'Date_Of_birth' : date.strftime('%Y-%m-%d'),
        'tel' : "+212 " + phone_number[1:4] + " " + phone_number[4:7] + " " + phone_number[7:],
        'address' : fake.address() ,
        'taille' : "0" ,
        'poids' : "0" ,
        'date_rendez': date.strftime('%Y-%m-%d'),
        'heure_rendez': fake.time_object().strftime('%H:%M'),
        'service' : random.choice(services)
        # Ajoutez d'autres attributs d'utilisateur si nécessaire
    }
    #print(list(user.values()))
    #users.append(user)
    with open(filename, 'a', newline='') as csvfile:
        writer = csv.writer(csvfile)
        #writer.writerow(['CIN', 'First_Name', 'Last_Name', 'Date_Of_birth','tel','date_rendez','heure_rendez','service'])  # Write header
        writer.writerow(list(user.values()))  # Write data rows