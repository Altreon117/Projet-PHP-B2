-- Table USERS (Utilisateurs et Admins)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') DEFAULT 'client' NOT NULL
) ENGINE=InnoDB;

-- Table ITEMS (Produits)
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    nombre_achete INT DEFAULT 0,
    date_publication DATETIME DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255)
    categorie VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- Table STOCK (Gestion des quantités)
CREATE TABLE stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_item INT NOT NULL,
    quantite INT NOT NULL,
    FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE
) ENGINE=InnoDB;

--  Table INVOICE (Factures)
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

-- Table ORDERS (Détails des commandes)
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