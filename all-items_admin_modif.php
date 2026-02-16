<?php
/**
 * Script de modification d'objet (all-items_admin_modif.php).
 *
 * Traite le formulaire de modification d'un item existant.
 * Met à jour les informations en base de données.
 */
require_once 'core/db.php';
require_once 'core/admin_auth.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: all-items_admin.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    header("Location: all-items_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prix = $_POST['prix'] ?? 0;
    $image = $_POST['image_path'] ?? '';
    $description_stat = $_POST['description_stat'] ?? '';
    $description_passive = $_POST['description_passive'] ?? '';
    $quantite = $_POST['quantite'] ?? 0;

    $stmt = $pdo->prepare("UPDATE items SET nom=?, prix=?, image=?, description_stat=?, description_passive=?, stock=? WHERE id=?");
    if ($stmt->execute([$nom, $prix, $image, $description_stat, $description_passive, $quantite, $id])) {
        header("Location: all-items_admin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un objet</title>
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
             <div class="shop-title">MODIFIER OBJET</div>
        </main>

        <form method="POST" class="shop-main-content-form">
            <div class="shop-details-panel-form">
                <div class="builds-into">
                    <h4>MODIFICATION</h4>
                    <div class="builds-into-grid">
                         <img src="<?php echo htmlspecialchars($item['image']); ?>" style="width:50px;height:50px;border:1px solid #c8aa6e;">
                    </div>
                </div>

                <div class="big-item-display">
                    <input type="text" name="image_path" class="hextech-input-image" value="<?php echo htmlspecialchars($item['image']); ?>" required>
                </div>

                <div class="selected-item-info">
                    <div class="item-header-text">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" class="hextech-input-title" value="<?php echo htmlspecialchars($item['nom']); ?>" required>
                
                        <div class="price">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Gold">
                            <label for="prix">Prix</label>
                            <input type="number" name="prix" class="hextech-input-gold" value="<?php echo (int)$item['prix']; ?>" min="0" step="1" required>
                        </div>
                    </div>
                </div>
                <div class="big-description">
                    <div class="description">
                         <label for="description_stat">Stats (ex: +40 AD)</label>
                        <textarea name="description_stat" class="hextech-textarea" style="height:100px;" required><?php echo htmlspecialchars($item['description_stat']); ?></textarea>
                        
                        <label for="description_passive">Passif (ex: Unique - Couperet...)</label>
                        <textarea name="description_passive" class="hextech-textarea" style="height:100px;" required><?php echo htmlspecialchars($item['description_passive']); ?></textarea>
                    </div>
                </div>
                <div class="quantity-container">
                    <label for="quantite">Stock</label>
                    <input type="number" name="quantite" class="hextech-input-quantity" value="<?php echo htmlspecialchars($item['stock']); ?>" min="0" required>
                </div>
            </div>

            <button type="submit" class="btn-purchase btn-create">ENREGISTRER</button>
        </form>
    </div>
</body>
</html>