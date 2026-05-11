CREATE DATABASE regime;
Use regime;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(100) NOT NULL,
    genre ENUM('homme','femme'),
    roles ENUM('admin','user') DEFAULT 'user',
    taille INT, 
    poids DECIMAL(5,2),  
    imc DECIMAL(5,2),
    solde DECIMAL(10,2) DEFAULT 0,
    gold BOOLEAN DEFAULT false,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);




CREATE TABLE objectif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_objectif VARCHAR(50) NOT NULL
);
INSERT INTO objectif(nom_objectif) VALUES
("Perdre du poids"), 
("Prendre du poids"),
("IMC ideal");





CREATE TABLE user_objectif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_objectif INT,
    date_choix DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_objectif) REFERENCES objectif(id)
);



CREATE TABLE activite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    types ENUM('perte_poids','prise_poids','maintien'),
    calories_brulees INT
);

CREATE TABLE regime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    pourcentage_viande INT,
    pourcentage_poisson INT,
    pourcentage_volaille INT
);
CREATE TABLE regime_prix (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_regime INT,
    duree INT,
    prix DECIMAL(10,2),
    variation_poids DECIMAL(5,2), 
    FOREIGN KEY (id_regime) REFERENCES regime(id)
);



-- CREATE TABLE suggestion (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     id_objectif INT,
--     id_regime INT,
--     id_activite INT,
--     duree INT,
--     FOREIGN KEY (id_objectif) REFERENCES objectif(id),
--     FOREIGN KEY (id_regime) REFERENCES regime(id),
--     FOREIGN KEY (id_activite) REFERENCES activite(id)
-- );

CREATE TABLE code (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) UNIQUE,
    montant DECIMAL(10,2),
    utilise BOOLEAN DEFAULT FALSE
);

CREATE TABLE parametre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cle VARCHAR(100) UNIQUE NOT NULL,
    valeur VARCHAR(255) NOT NULL,
    description VARCHAR(255)
);



-- CREATE TABLE transaction (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     id_utilisateur INT,
--     montant DECIMAL(10,2),
--     type ENUM('recharge','achat'),
--     date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
-- );


CREATE TABLE paiement_gold (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    montant DECIMAL(10,2),
    date_paiement DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES user(id)
);