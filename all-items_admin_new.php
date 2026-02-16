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
    $description_stat = $_POST['description_stat'] ?? '';
    $description_passive = $_POST['description_passive'] ?? '';
    $quantite = $_POST['quantite'] ?? 0;

    $stats = [
        'ad' => 0, 'ap' => 0, 'health' => 0, 'armor' => 0, 'magic_resistance' => 0,
        'attack_speed' => 0, 'ability_haste' => 0, 'crit_rate' => 0, 'mana' => 0,
        'magic_penetration' => 0, 'armor_penetration' => 0, 'omnivamp' => 0,
        'physical_vamp' => 0, 'health_regeneration' => 0, 'tenacity' => 0
    ];

    $patterns = [
        'ad' => '/(\d+)\s*(?:Force d\'attaque|AD|Dégâts d\'attaque)/i',
        'ap' => '/(\d+)\s*(?:Puissance|AP)/i',
        'health' => '/(\d+)\s*(?:PV|Santé|Points de vie)/i',
        'armor' => '/(\d+)\s*(?:Armure)/i',
        'magic_resistance' => '/(\d+)\s*(?:Résistance magique|RM|MR)/i',
        'attack_speed' => '/(\d+)\s*%\s*(?:Vitesse d\'attaque|AS)/i',
        'ability_haste' => '/(\d+)\s*(?:Accélération de compétence|Haste|AH)/i',
        'crit_rate' => '/(\d+)\s*%\s*(?:Chance de coup critique|Crit)/i',
        'mana' => '/(\d+)\s*(?:Mana)/i',
        'magic_penetration' => '/(\d+)\s*(?:Pénétration magique)/i',
        'armor_penetration' => '/(\d+)\s*(?:Létalité|Pénétration d\'armure)/i',
        'omnivamp' => '/(\d+)\s*%\s*(?:Omnivampirisme|Omnivamp)/i',
        'physical_vamp' => '/(\d+)\s*%\s*(?:Vampirisme physique)/i',
        'health_regeneration' => '/(\d+)\s*%\s*(?:Régénération de base des PV)/i',
        'tenacity' => '/(\d+)\s*%\s*(?:Ténacité)/i'
    ];

    foreach ($patterns as $key => $pattern) {
        if (preg_match($pattern, $description_stat, $matches)) {
            $stats[$key] = (int)$matches[1];
        }
    }

    $categorie = 'fighter';
    $descLower = strtolower($description_stat . ' ' . $nom);

    if (strpos($descLower, 'vitesse de déplacement') !== false || strpos($descLower, 'bottes') !== false) {
        $categorie = 'boots';
    }
    elseif ($stats['ap'] > 0 || $stats['mana'] > 0 || $stats['magic_penetration'] > 0) {
        $categorie = 'mage';
    }
    elseif ($stats['crit_rate'] > 0 || $stats['attack_speed'] > 0) {
        $categorie = 'marksman';
    }
    elseif ($stats['armor'] > 0 || $stats['magic_resistance'] > 0 || $stats['health'] > 300) {
        $categorie = 'tank';
    }
    elseif ($stats['armor_penetration'] > 0) {
        $categorie = 'assassin';
    }
    elseif ($stats['ability_haste'] > 0 && $stats['health'] > 0) {
        $categorie = 'support';
    }

    $stmt = $pdo->prepare("INSERT INTO items (
        nom, prix, image, description_stat, description_passive, categorie, stock,
        ad, ap, health, armor, magic_resistance, attack_speed, ability_haste,
        crit_rate, mana, magic_penetration, armor_penetration, omnivamp,
        physical_vamp, health_regeneration, tenacity
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $params = [
        $nom, $prix, $image, $description_stat, $description_passive, $categorie, $quantite,
        $stats['ad'], $stats['ap'], $stats['health'], $stats['armor'], $stats['magic_resistance'],
        $stats['attack_speed'], $stats['ability_haste'], $stats['crit_rate'], $stats['mana'],
        $stats['magic_penetration'], $stats['armor_penetration'], $stats['omnivamp'],
        $stats['physical_vamp'], $stats['health_regeneration'], $stats['tenacity']
    ];

    if ($stmt->execute($params)) {
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

        <form class="shop-main-content-form" action="" method="POST">
            <div class="shop-details-panel-form">
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
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" class="hextech-input-title" placeholder="Nom de l'objet" required>
                    
                            <div class="price">
                                <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Gold">
                                <label for="prix">Prix</label>
                                <input type="number" name="prix" class="hextech-input-gold" placeholder="Prix" min="0" step="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="big-description">
                        <div class="description">
                             <label for="description_stat">Stats (ex: +40 AD)</label>
                            <textarea name="description_stat" class="hextech-textarea" placeholder="Stats (ex: +30 AD, +300 PV)" style="height:100px;" required></textarea>
                            
                            <label for="description_passive">Passif</label>
                            <textarea name="description_passive" class="hextech-textarea" placeholder="Passif (Unique - ...)" style="height:100px;" required></textarea>
                        </div>
                    </div>
                    <div class="quantity-container">
                        <label for="quantite">Stock</label>
                        <input type="number" name="quantite" class="hextech-input-quantity" placeholder="Quantité" min="1" required>
                    </div>
                </div>

                <button type="submit" class="btn-purchase btn-create">CRÉER L'OBJET</button>
            </div>
        </form>
        </form>
    </div>
</body>
</html>