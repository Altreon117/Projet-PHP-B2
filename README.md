# 🎮 Antre du Poro - E-Commerce League of Legends

Une boutique e-commerce dynamique et moderne thématisée sur l'univers League of Legends, permettant aux utilisateurs d'acheter des objets et des consommables avec un système complet de gestion administrateur.

## 📋 Table des matières
- [Fonctionnalités](#fonctionnalités)
- [Technologies](#technologies)
- [Installation](#installation)
- [Architecture](#architecture)
- [Base de données](#base-de-données)
- [Utilisation](#utilisation)
- [Fonctionnalités administrateur](#fonctionnalités-administrateur)

---

## ✨ Fonctionnalités

### Pour les clients

- **🛍️ Parcourir les produits**
  - Catalogue complet des items et consommables
  - Filtrage par catégorie et statistiques RPG
  - Recherche avancée des produits
  - Affichage des détails et propriétés des items
  
- **❤️ Système de favoris**
  - Marquer les articles en favoris
  - Gestion personnelle de la wishlist
  - Sauvegarde en base de données

- **🛒 Gestion du panier**
  - Ajout/suppression d'articles
  - Ajustement des quantités
  - Calcul du total en temps réel
  - Persistance de session

- **💳 Système de paiement**
  - Checkout sécurisé
  - Adresse de facturation
  - Création de factures numériques
  - Historique des commandes

- **👤 Authentification**
  - Inscription simple et sécurisée
  - Connexion avec email/mot de passe
  - Sessions utilisateur
  - Mots de passe hachés (bcrypt)

### Pour les administrateurs

- **📦 Gestion des produits**
  - Créer, modifier, supprimer des items
  - Gestion du stock
  - Uploads d'images
  - Configuration des statistiques (AD, AP, Armor, etc.)

- **👥 Gestion des utilisateurs**
  - Consulter les utilisateurs
  - Gérer les rôles (client/admin)
  - Créer des comptes administrateur

- **📊 Gestion des commandes**
  - Consulter les commandes
  - Voir les factures
  - Suivi des ventes

- **📝 Configuration**
  - Gestion des catégories
  - Paramètres du site
  - Données d'inventaire

---

## 🛠️ Technologies

### Backend
- **PHP 7.4+** - Langage serveur
- **MySQL** - Base de données relationnelle

### Frontend
- **HTML** - Structure
- **CSS** - Styling avec design thématique LoL
- **JavaScript Vanilla** - Interactions dynamiques

### Outils
- **XAMPP** - Stack de développement (Apache, MySQL, PHP)
- **Composer** (optionnel) - Gestion des dépendances

---

## 🚀 Installation

### Prérequis
- XAMPP (ou Apache + MySQL + PHP 7.4+)
- PHP PDO extensions

### Étapes

1. **Cloner le projet via VSCode**
   - Dans C:\xampp\htdocs (le dossier xampp se trouve a la racine de votre disque dur)

   ```bash
   git clone <repo-url>
   cd Projet-PHP-B2
   ```
2. **Créer db.php**
   - Dans le dossier /core créez un fichier db.php et collez-y le contenu de db.exemple.php 

3. **Configurer la base de données**
   - Ouvrez Xampp et demarrer Apache et MySQL (ils doivent devenir vert) puis cliquez sur le bouton 'Admin' de la ligne de 'MySQL'.
   - Rendez vous sur la page phpMyAdmin (http://localhost/phpmyadmin) qui s'est ouverte,
   - Créez une nouvelle base de données : `ecommerce_php`

5. **Importer le schéma**
   ```sql
   -- Dans phpMyAdmin, copiez dans l'onglet SQL le fichier :
   database/schema.sql
   ```

6. **Charger les données**
   ```sql
   -- Recommencez l'operation pour charger les fixtures :
   database/fixtures.sql
   ```
8. **Accéder au site**
   - Frontend : http://localhost/Projet-PHP-B2
   - Admin : http://localhost/Projet-PHP-B2/index_admin.php

---

## 📁 Architecture

```
Projet-PHP-B2/
├── core/                         # Backend logique
│   ├── db.php                    # Connexion MySQL (PDO)
│   ├── admin_auth.php            # Authentification administrateur
│   ├── cart_actions.php          # Gestion du panier
│   ├── checkout.php              # Processus de paiement
│   ├── search_items.php          # Recherche avancée
│   ├── toggle_favorite.php       # Système de favoris
│   ├── delete_item.php           # Suppression d'articles
│   └── db.example.php            # Configuration d'exemple
│
├── database/                     # Schéma et données
│   ├── schema.sql                # Structure des tables
│   └── fixtures.sql              # Données de test
│
├── views/                        # Templates HTML
│   ├── admin/                    # Templates administration
│   ├── front/                    # Templates publiques
│   └── layouts/                  # Layouts réutilisables
│
├── assets/                       # Ressources statiques
│   ├── css/
│   │   └── style.css             # Stylesheet principal
│   ├── img/                      # Images du site
│   │   ├── items/                # Images produits
│   │   ├── consumables/          # Images consommables
│   │   ├── boots/                # Catégorie objets
│   │   ├── logos/                # Logos et icônes
│   │   └── pp/                   # Photos de profil
│   └── js/                       # Scripts JavaScript
│       ├── cart.js               # Gestion du panier
│       ├── shop.js               # Interactions boutique
│       ├── admin.js              # Fonctionnalités admin
│       ├── search.js             # Recherche
│       ├── validation.js         # Validation formulaires
│       └── cart-interactions.js  # UX du panier
│
├── index.php                     # Page d'accueil publique
├── index_admin.php               # Tableau de bord admin
├── connexion.php                 # Page de connexion
├── inscription.php               # Page d'inscription
├── panier.php                    # Page du panier
├── panier_admin.php              # Gestion panier admin
├── all-items.php                 # Catalogue complet
├── all-items_admin.php           # Gestion items admin
├── all-items_admin_new.php       # Créer nouvel item
├── all-items_admin_modif.php     # Modifier item
├── check_cats.php                # Gestion des catégories
├── check_trinkets.php            # Gestion des objets
├── gestion_user.php              # Gestion des utilisateurs
├── credit.php                    # Page crédits
├── populate_items.php            # Script de peuplement DB
├── setup_consumables.php         # Configuration consommables
└── README.md                     # Ce fichier
```

---

## 🗄️ Base de données

### Tables principales

#### `users`
- Stocke les utilisateurs et administrateurs
- Champs : id, nom, email, password (hashé), role

#### `items`
- Catalogue des produits
- Champs : id, nom, description, prix, stock, image, catégorie, statistiques RPG

#### `stock`
- Gestion de l'inventaire
- Relation : item → quantité disponible

#### `invoice`
- Factures des commandes
- Champs : id, id_user, montant, adresse, date_transaction

#### `orders`
- Articles commandés
- Relation : invoice → items, utilisateur

#### `user_favorites`
- Articles en favoris
- Relation M2M : utilisateur → articles

---

## 💻 Utilisation

### Se connecter

1. Aller sur [http://localhost/Projet-PHP-B2/connexion.php](http://localhost/Projet-PHP-B2)
2. Créer un compte via l'inscription
3. Se connecter avec ses identifiants

### Naviguer dans la boutique

- **Accueil** : Affichage des produits phares
- **Catalogue** : Tous les articles avec filtres
- **Panier** : Gestion du panier et checkout
- **Favoris** : Articles en favori (si connecté)

### Comme administrateur

1. Créer un compte avec le rôle `admin` en base de données :
  - Retournez dans phpMyAdmin, ouvreez la table dess utilisateurs puis trouvez votrre profil
  - Double-cliquez sur votre rôle (client) et sélectionnez 'admin'
  - Cliquez hors des cases pour enregistrer la modification, vous devriez avoir un message tel que '1 ligne affectée'.
2. Retourner se connecter sur le site
3. Vous voilà administrateur du site !
4. Gérer :
   - ✏️ Produits (créer, modifier, supprimer)
   - 👥 Utilisateurs
   - 📊 Commandes et factures
   - 📦 Stock et inventaire

---

## 🎨 Thème et Design

Le site utilise un design thématisé **League of Legends** avec :
- Couleurs et typographie inspirées de l'univers LoL
- Icônes et visuels issus du jeu
- Interface de type "Poro Shop"
- Système de statistiques RPG pour les items (AD, AP, Armor, etc.)

---

## 📝 Notes de développement

### Sécurité
- ✅ Mots de passe hachés (password_hash)
- ✅ Prévention SQL injection (requêtes préparées PDO)
- ✅ Validation des entrées utilisateur
- ✅ Sessions sécurisées
- ⚠️ À améliorer : CSRF tokens, validation côté serveur renforcée

### Extensions futures possibles
- 🔄 Système de panier persistent
- 📧 Notifications par email
- ⭐ Système d'avis clients
- 🎯 Filtres de recherche avancés
- 📱 Responsive design optimisé
- 🔐 Authentification 2FA

**Créé pour le projet B2 - Développement e-commerce en PHP**
