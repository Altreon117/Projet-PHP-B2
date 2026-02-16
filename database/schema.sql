-- Désactiver les vérifications de clés étrangères pour pouvoir supprimer les tables dans n'importe quel ordre
SET FOREIGN_KEY_CHECKS = 0;

-- 1. Suppression des tables existantes (Nettoyage)
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS invoice;
DROP TABLE IF EXISTS stock;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS user_favorites;

-- Réactiver les vérifications
SET FOREIGN_KEY_CHECKS = 1;

-- 2. Création des tables 

-- Table USERS
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') DEFAULT 'client' NOT NULL
) ENGINE=InnoDB;

-- Table ITEMS 
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description_stat TEXT,     
    description_passive TEXT,  
    prix DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    nombre_achete INT DEFAULT 0,
    date_publication DATETIME DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255),
    categorie VARCHAR(50) NOT NULL,
    role TEXT,
    ad INT DEFAULT 0,
    crit_rate INT DEFAULT 0,
    attack_speed INT DEFAULT 0,
    physical_vamp INT DEFAULT 0,
    armor_penetration INT DEFAULT 0,
    ap INT DEFAULT 0,
    mana INT DEFAULT 0,
    magic_penetration INT DEFAULT 0,
    health INT DEFAULT 0,
    health_regeneration INT DEFAULT 0,
    armor INT DEFAULT 0,
    magic_resistance INT DEFAULT 0,
    tenacity INT DEFAULT 0,
    ability_haste INT DEFAULT 0,
    omnivamp INT DEFAULT 0,
    favoris BOOLEAN DEFAULT 0
) ENGINE=InnoDB;

-- Table STOCK
CREATE TABLE stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_item INT NOT NULL,
    quantite INT NOT NULL,
    FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Table INVOICE
CREATE TABLE invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
    montant DECIMAL(10, 2) NOT NULL,
    adresse_facturation VARCHAR(255) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    code_postal VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id)
) ENGINE=InnoDB;

-- Table ORDERS
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_invoice INT NOT NULL,
    id_user INT NOT NULL,
    id_item INT NOT NULL,
    quantite INT DEFAULT 1, 
    FOREIGN KEY (id_invoice) REFERENCES invoice(id),
    FOREIGN KEY (id_user) REFERENCES users(id),
    FOREIGN KEY (id_item) REFERENCES items(id)
) ENGINE=InnoDB;

-- Table user_favorites
CREATE TABLE user_favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_item INT NOT NULL,
    UNIQUE KEY unique_user_item (id_user, id_item),
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE
) ENGINE=InnoDB;