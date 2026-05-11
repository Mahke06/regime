INSERT INTO user 
(nom, email, mot_de_passe, genre, roles, taille, poids, imc, solde, gold, date_inscription) 
VALUES

('Admin User', 'admin@regime.local', 'admin123', 'homme', 'admin',175, 75, 24.5, 0, 0, NOW()),
('Jean Dupont', 'jean@test.com', 'jean123', 'homme', 'user',180, 85, 26.2, 50.00, 0, DATE_SUB(NOW(), INTERVAL 30 DAY)),
('Marie Curie', 'marie@test.com', 'marie123', 'femme', 'user',165, 65, 23.9, 100.00, 1, DATE_SUB(NOW(), INTERVAL 20 DAY)),
('Sophie Martin', 'sophie@test.com', 'sophie123', 'femme', 'user',160, 95, 37.1, 0, 1, DATE_SUB(NOW(), INTERVAL 15 DAY)),
('Pierre Durand', 'pierre@test.com', 'pierre123', 'homme', 'user',185, 90, 26.8, 0, 0, DATE_SUB(NOW(), INTERVAL 10 DAY)),
('Isabelle Moreau', 'isabelle@test.com', 'isabelle123', 'femme', 'user',170, 80, 27.7, 0, 0, DATE_SUB(NOW(), INTERVAL 5 DAY)),
('Laurent Petit', 'laurent@test.com', 'laurent123', 'homme', 'user',175, 85, 27.2, 0, 0, DATE_SUB(NOW(), INTERVAL 2 DAY)),
('Anne Lefevre', 'anne@test.com', 'anne123', 'femme', 'user',160, 70, 27.3, 0, 0, DATE_SUB(NOW(), INTERVAL 1 DAY));






-- Insertion des Utilisateurs-Objectifs
INSERT INTO user_objectif (id_user, id_objectif) VALUES
(2, 1), -- Jean: Perdre du poids
(3, 3), -- Marie: IMC ideal
(3, 1), -- Marie: Perdre du poids
(4, 1), -- Sophie: Perdre du poids
(5, 2), -- Pierre: Prendre du poids
(6, 3), -- Isabelle: IMC ideal
(7, 1), -- Laurent: Perdre du poids
(8, 3); -- Anne: IMC ideal

-- Insertion des Activités
INSERT INTO activite (nom, types, calories_brulees) VALUES
('Course à pied', 'perte_poids', 600),
('Natation', 'perte_poids', 500),
('Musculation légende', 'prise_poids', 400),
('Yoga', 'maintien', 200),
('Vélo', 'perte_poids', 450),
('Marche rapide', 'perte_poids', 300),
('Musculation lourde', 'prise_poids', 800),
('Pilates', 'maintien', 250),
('CrossFit', 'perte_poids', 700),
('Boxe', 'perte_poids', 550);

-- Insertion des Régimes
INSERT INTO regime (nom, pourcentage_viande, pourcentage_poisson, pourcentage_volaille) VALUES
('Régime Méditerranéen', 20, 40, 20),
('Régime Kéto', 40, 30, 20),
('Régime Vegan', 0, 0, 0),
('Régime Hypocalorique', 25, 30, 25),
('Régime Protéiné', 35, 25, 35);

-- Insertion des Prix Régimes
INSERT INTO regime_prix (id_regime, duree, prix, variation_poids) VALUES
(1, 1, 29.99, -1.0),
(1, 3, 79.99, -3.0),
(1, 6, 149.99, -5.0),
(2, 1, 34.99, -1.5),
(2, 3, 89.99, -4.0),
(2, 6, 169.99, -6.0),
(3, 1, 24.99, -0.5),
(3, 3, 69.99, -2.0),
(3, 6, 129.99, -3.0),
(4, 1, 19.99, -0.3),
(4, 3, 49.99, -1.0),
(4, 6, 99.99, -2.0),
(5, 1, 39.99, -2.0),
(5, 3, 99.99, -5.0),
(5, 6, 189.99, -8.0);

-- Insertion des Codes Promo
INSERT INTO code (code, montant, utilise) VALUES
('WELCOME2024', 10.00, 0),
('SUMMER25', 15.00, 1),
('NEWUSER', 5.00, 1),
('FITNESS50', 50.00, 0),
('BONUS20', 20.00, 1),
('SPECIAL30', 30.00, 0),
('GOLD100', 100.00, 0),
('DISCOUNT25', 25.00, 1),
('VIP75', 75.00, 0),
('SPRING40', 40.00, 1),
('HEALTH10', 10.00, 0),
('PROMO60', 60.00, 1),
('FIRST5', 5.00, 0),
('LUCKY50', 50.00, 0),
('MEGA200', 200.00, 1);

INSERT INTO parametre (cle, valeur, description) VALUES
('gold_price', '9.99', 'Prix de l abonnement Gold'),
('gold_discount', '15', 'Remise Gold en pourcentage'),
('max_objectifs', '3', 'Nombre maximum d objectifs par utilisateur');

-- Insertion des Paiements Gold
INSERT INTO paiement_gold (id_utilisateur, montant, date_paiement) VALUES
(3, 50.00, DATE_SUB(NOW(), INTERVAL 20 DAY)),
(4, 50.00, DATE_SUB(NOW(), INTERVAL 15 DAY)),
(6, 50.00, DATE_SUB(NOW(), INTERVAL 8 DAY)),
(8, 50.00, DATE_SUB(NOW(), INTERVAL 1 DAY));
