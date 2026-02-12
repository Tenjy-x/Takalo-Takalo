-- Script de création de la base de données Takalo-takalo
-- Date: Février 2026

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS takalo_takalo;

USE takalo_takalo;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    role VARCHAR(20) NOT NULL,
    est_actif BOOLEAN DEFAULT TRUE
);

-- Table des catégories
CREATE TABLE IF NOT EXISTS categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL UNIQUE,
    description_categorie TEXT,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des objets
CREATE TABLE IF NOT EXISTS objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    prix_estimatif DECIMAL(10,2) NOT NULL,
    id_utilisateur_proprietaire INT NOT NULL,
    id_categorie INT NOT NULL,
    date_publication DATETIME DEFAULT CURRENT_TIMESTAMP,
    est_disponible BOOLEAN DEFAULT TRUE,
    est_actif BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_utilisateur_proprietaire) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie) ON DELETE RESTRICT
);

-- Table des photos d'objets
CREATE TABLE IF NOT EXISTS photo_objet (
    id_photo INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    chemin_photo VARCHAR(500) NOT NULL,
    est_photo_principale BOOLEAN DEFAULT FALSE,
    date_upload DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE
);

-- Table des échanges
CREATE TABLE IF NOT EXISTS echange (
    id_echange INT AUTO_INCREMENT PRIMARY KEY,
    id_objet_propose INT NOT NULL,
    id_objet_demande INT NOT NULL,
    id_utilisateur_proposant INT NOT NULL,
    id_utilisateur_destinataire INT NOT NULL,
    statut ENUM('en_attente', 'accepte', 'refuse', 'annule', 'termine') DEFAULT 'en_attente',
    date_proposition DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_reponse DATETIME NULL,
    date_validation DATETIME NULL,
    FOREIGN KEY (id_objet_propose) REFERENCES objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_objet_demande) REFERENCES objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur_proposant) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur_destinataire) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
);

-- Table historique des propriétaires
CREATE TABLE IF NOT EXISTS historique_proprietaire (
    id_historique INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    id_utilisateur_ancien_proprietaire INT,
    id_utilisateur_nouveau_proprietaire INT NOT NULL,
    date_transfert DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_echange INT,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur_ancien_proprietaire) REFERENCES utilisateur(id_utilisateur) ON DELETE SET NULL,
    FOREIGN KEY (id_utilisateur_nouveau_proprietaire) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_echange) REFERENCES echange(id_echange) ON DELETE SET NULL
);

-- Insertion des données de test

-- 1. Admin par défaut (mot de passe: admin123 - à hasher en PHP)
-- INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, est_admin) VALUES
-- ('Admin', 'System', 'admin@takalo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE);

-- 2. Utilisateurs de test
-- INSERT INTO utilisateur (nom, prenom, email, mot_de_passe) VALUES
-- ('Durand', 'Jean', 'jean.durand@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
-- ('Martin', 'Sophie', 'sophie.martin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
-- ('Petit', 'Lucas', 'lucas.petit@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- 3. Catégories
INSERT INTO categorie (nom_categorie, description_categorie) VALUES
('Vêtements', 'Vêtements homme, femme, enfant'),
('Livres', 'Romans, BD, manuels scolaires, essais'),
('DVD', 'Films, séries, documentaires'),
('Jeux vidéo', 'Jeux pour toutes consoles'),
('Informatique', 'Ordinateurs, accessoires, composants'),
('Sports', 'Équipements et vêtements de sport'),
('Musique', 'Instruments, CD, vinyles');

-- 4. Objets de test
INSERT INTO objet (titre, description, prix_estimatif, id_utilisateur_proprietaire, id_categorie) VALUES
('Jean Levis taille 32', 'Jean bleu foncé, très bon état, porté 5 fois', 25.00, 2, 1),
('Le Petit Prince', 'Édition collector, comme neuf', 15.00, 3, 2),
('Inception DVD', 'Film de Nolan, édition spéciale', 10.00, 4, 3),
('Console PS5', 'Cons   ole en excellent état, avec manette', 350.00, 2, 4),
('MacBook Pro 2019', 'Ordinateur portable, 256Go SSD, 8Go RAM', 800.00, 3, 5);

-- 5. Photos des objets
INSERT INTO photo_objet (id_objet, chemin_photo, est_photo_principale) VALUES
(1, '/uploads/objets/1/jean_principal.jpg', TRUE),
(1, '/uploads/objets/1/jean_detail1.jpg', FALSE),
(1, '/uploads/objets/1/jean_detail2.jpg', FALSE),
(2, '/uploads/objets/2/livre_principal.jpg', TRUE),
(3, '/uploads/objets/3/dvd_principal.jpg', TRUE),
(4, '/uploads/objets/4/ps5_principal.jpg', TRUE),
(4, '/uploads/objets/4/ps5_manette.jpg', FALSE),
(5, '/uploads/objets/5/macbook_principal.jpg', TRUE);

-- 6. Échanges de test
INSERT INTO echange (id_objet_propose, id_objet_demande, id_utilisateur_proposant, id_utilisateur_destinataire, statut, date_proposition) VALUES
(1, 2, 2, 3, 'accepte', DATE_SUB(NOW(), INTERVAL 10 DAY)),
(3, 4, 4, 2, 'refuse', DATE_SUB(NOW(), INTERVAL 5 DAY)),
(5, 1, 3, 2, 'en_attente', DATE_SUB(NOW(), INTERVAL 1 DAY));

-- 7. Mise à jour des échanges acceptés
UPDATE echange SET date_reponse = DATE_SUB(NOW(), INTERVAL 8 DAY), date_validation = DATE_SUB(NOW(), INTERVAL 8 DAY) WHERE id_echange = 1;
UPDATE echange SET date_reponse = DATE_SUB(NOW(), INTERVAL 3 DAY) WHERE id_echange = 2;

-- 8. Historique des propriétaires
INSERT INTO historique_proprietaire (id_objet, id_utilisateur_ancien_proprietaire, id_utilisateur_nouveau_proprietaire, date_transfert, id_echange) VALUES
(2, 3, 2, DATE_SUB(NOW(), INTERVAL 8 DAY), 1),
(1, 2, 3, DATE_SUB(NOW(), INTERVAL 8 DAY), 1);

-- Création des index pour les performances
CREATE INDEX idx_objet_utilisateur ON objet(id_utilisateur_proprietaire);
CREATE INDEX idx_objet_categorie ON objet(id_categorie);
CREATE INDEX idx_objet_disponible ON objet(est_disponible);
CREATE INDEX idx_echange_statut ON echange(statut);
CREATE INDEX idx_echange_destinataire ON echange(id_utilisateur_destinataire);
CREATE INDEX idx_echange_proposant ON echange(id_utilisateur_proposant);
CREATE INDEX idx_historique_objet ON historique_proprietaire(id_objet);
CREATE INDEX idx_historique_date ON historique_proprietaire(date_transfert);

-- Vue pour les statistiques admin
CREATE VIEW stats_admin AS
SELECT 
    (SELECT COUNT(*) FROM utilisateur WHERE est_actif = TRUE) as nb_utilisateurs_actifs,
    (SELECT COUNT(*) FROM utilisateur) as nb_utilisateurs_total,
    (SELECT COUNT(*) FROM echange WHERE statut IN ('accepte', 'termine')) as nb_echanges_effectues,
    (SELECT COUNT(*) FROM objet WHERE est_actif = TRUE) as nb_objets_disponibles,
    (SELECT COUNT(*) FROM objet) as nb_objets_total;