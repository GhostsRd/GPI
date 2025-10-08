CREATE TABLE equipements_it (
id INT AUTO_INCREMENT PRIMARY KEY,
type_equipement ENUM(
'Ordinateur', 'Moniteur', 'Logiciel', 'Imprimante',
'Matériel Réseau', 'Périphérique', 'Téléphone/Tablette'
) NOT NULL,

-- Champs communs
nom VARCHAR(150) NOT NULL,
entite VARCHAR(100),
statut VARCHAR(50),
fabricant VARCHAR(100),
modele VARCHAR(100),
numero_serie VARCHAR(100),
usager VARCHAR(100),
lieu VARCHAR(150),
date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
date_mise_a_jour TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

-- Champs spécifiques aux ordinateurs
utilisateur VARCHAR(100),
date_dernier_inventaire DATE,
assistance_nombre_tickets INT,
reseau_ip VARCHAR(50),
composants_taille_disque VARCHAR(50),
systeme_exploitation_version VARCHAR(100),
systeme_exploitation_noyau VARCHAR(100),
derniere_date_demarrage DATETIME,
sous_entites VARCHAR(150),

-- Champs spécifiques aux moniteurs
commentaires TEXT,

-- Champs spécifiques aux logiciels
editeur VARCHAR(100),
version_nom VARCHAR(50),
version_systeme_exploitation VARCHAR(100),
nombre_installations INT,
nombre_licences INT,

-- Champs spécifiques aux imprimantes
type_imprimante VARCHAR(50),

-- Champs spécifiques au matériel réseau
type_reseau VARCHAR(50),

-- Champs spécifiques aux périphériques
type_peripherique VARCHAR(50),

-- Champs spécifiques aux téléphones / tablettes
services TEXT,
emplacement_actuel VARCHAR(150),
imei VARCHAR(50)
);
