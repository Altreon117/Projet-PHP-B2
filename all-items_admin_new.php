<?php
/**
 * Page de création d'objet (all-items_admin_new.php).
 *
 * Affiche le formulaire de création et traite l'insertion d'un nouvel item en base.
 */
require_once 'core/db.php';
require_once 'core/admin_auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prix = $_POST['prix'] ?? 0;
    $image = $_POST['image_path'] ?? '';
    $stats = $_POST['stats'] ?? '';
    $description = $_POST['description'] ?? '';
    $quantite = $_POST['quantite'] ?? 0;

    $categorie = 'fighter';
    if (stripos($stats, 'ap') !== false || stripos($stats, 'mana') !== false)
        $categorie = 'mage';
    elseif (stripos($stats, 'crit') !== false || stripos($stats, 'speed') !== false)
        $categorie = 'marksman';
    elseif (stripos($stats, 'health') !== false || stripos($stats, 'armor') !== false)
        $categorie = 'tank';

    $stmt = $pdo->prepare("INSERT INTO items (nom, prix, image, description, categorie, stock) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$nom, $prix, $image, $stats . "\n" . $description, $categorie, $quantite])) {
        header("Location: all-items_admin.php");
        exit;
    }
    else {
        $error = "Erreur lors de la création.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un objet</title>
    <link rel="stylesheet" href="/Projet-PHP-B2/assets/css/style.css">
</head>
<body>
    <div class="lol-shop-window">
        <div class="shop-sidebar-left">
             <div class="profile-section">
                <a href="connexion.php" class="profile-icon">
                    <img src="assets/img/logos/lol_icon.png" alt="Profil Icon">
                </a>
            </div>
            <div class="sidebar-block-admin">
                <a href="all-items_admin.php">Retour</a>
            </div>
        </div>

        <main class="shop-main-content">
             <div class="shop-title">NOUVEL OBJET</div>
        </main>

        <form class="shop-details-panel" action="" method="POST">
            <div class="builds-into">
                <h4>NOUVEL OBJET</h4>
                <div class="builds-into-grid">
                    <div class="item-square"></div>
                </div>
            </div>

            <div class="big-item-display">
                <input type="text" name="image_path" class="hextech-input-image" placeholder="Chemin (ex: assets/img/boots.png)" required>
            </div>

            <div class="selected-item-info">
                <div class="item-info-header">
                    <div class="item-square-little-item"></div>
            
                    <div class="item-header-text">
                        <input type="text" name="nom" class="hextech-input-title" placeholder="Nom de l'objet" required>
                
                        <div class="price">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Gold">
                            <input type="number" name="prix" class="hextech-input-gold" placeholder="Prix" required>
                        </div>
                    </div>
                </div>
                <div class="big-description">
                    <div class="description">
                        <textarea name="stats" class="hextech-textarea" placeholder="Stats (ex: +30 AD)" required></textarea>
                    </div>
                    <div class="description">
                        <textarea name="description" class="hextech-textarea" placeholder="Description/Passif" required></textarea>
                    </div>
                </div>
                <div class="quantity-container">
                    <label for="quantite">Stock</label>
                    <input type="number" name="quantite" class="hextech-input-quantity" placeholder="Quantité" min="1" required>
                </div>
            </div>

            <button type="submit" class="btn-purchase btn-create">CRÉER L'OBJET</button>
        </form>
    </div>
</body>
</html>