<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antre du Poro</title>
    <link rel="stylesheet" href="/Projet-PHP-B2/assets/css/style.css">
</head>

<body>

    <div class="lol-shop-window">
        <!-- SECTION DE GAUCHE AVEC LES CONSOMMABLES ET LES BOTTES -->
        <div class="shop-sidebar-left">
            <!-- PROFIL-->
            <div class="profile-section">
                <a href="connexion.php" class="profile-icon">
                    <img src="assets/img/logos/lol_icon.png" alt="Profil Icon">
                </a>
            </div>
            <!-- CONSOMMABLES -->
            <div class="sidebar-block-consumables">
                <?php
require_once 'core/db.php';
try {
    $stmt = $pdo->query("SELECT * FROM items WHERE categorie = 'consumable'");
    while ($item = $stmt->fetch()) {
        echo '<div class="mini-icon" onclick="adminSelectItem(this)"
                                data-id="' . htmlspecialchars($item['id']) . '"
                                data-name="' . htmlspecialchars($item['nom']) . '"
                                data-price="' . (int)$item['prix'] . '"
                                data-desc="' . htmlspecialchars($item['description']) . '"
                                data-img="' . htmlspecialchars($item['image']) . '">
                                <img class="item-square" src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['nom']) . '">
                                <a>' . (int)$item['prix'] . '</a>
                              </div>';
    }
    echo '<div class="mini-icon"><div class="item-square" style="visibility: hidden;"></div></div>';
}
catch (PDOException $e) {
    echo "Erreur";
}
?>
            </div>
            
            <!-- BOTTES -->
            <div class="sidebar-block-boots">
                <?php
try {
    $stmt = $pdo->query("SELECT * FROM items WHERE categorie = 'boots'");
    while ($item = $stmt->fetch()) {
        echo '<div class="mini-icon" onclick="adminSelectItem(this)"
                                data-id="' . htmlspecialchars($item['id']) . '"
                                data-name="' . htmlspecialchars($item['nom']) . '"
                                data-price="' . (int)$item['prix'] . '"
                                data-desc="' . htmlspecialchars($item['description']) . '"
                                data-img="' . htmlspecialchars($item['image']) . '">
                                <img class="item-square" src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['nom']) . '">
                                <a>' . (int)$item['prix'] . '</a>
                              </div>';
    }
}
catch (PDOException $e) {
    echo "Erreur";
}
?>
            </div>
            <div class="sidebar-block-admin">
                <a href="gestion_user.php">Gestion utilisateur</a>
            </div>
        </div>

        <!-- SECTION PRINCIPALE AVEC LES OBJETS -->
        <main class="shop-main-content">
            <!-- NAVIGATION -->
            <div class="shop-tabs">
                <a href="index_admin.php" >ACCUEIL</a>
                <a href="all-items_admin.php" >TOUS LES OBJETS</a>
                <a href="panier_admin.php" id="active">PANIER</a>
            </div>
            <!-- BARRE DE RECHERCHE ET FILTRE HORIZONTALE -->
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
            </div>
            <!-- PANNIER -->
            <div class="panier-section">
                <div class="item-spot-section">
                    <div class="item6-spot">
                        <div class="item-spot"></div>
                        <div class="item-spot"></div>
                        <div class="item-spot"></div>
                        <div class="item-spot"></div>
                        <div class="item-spot"></div>
                        <div class="item-spot"></div>
                    </div>
                    <div class="item7-adc-spot-section">
                        <div class="item-spot" ></div>
                    </div>
                </div>
                <div class="others-items-spot">
                    <?php
// Petite boucle PHP pour simuler plein d'objets et voir le scroll
for ($i = 0; $i < 20; $i++) {
    echo '<div class="item-square"></div>';
}
?>
                </div>
                <div class="panier-summary">
                    <div class="summary-row">
                        <span class="summary-label">Articles</span>
                        <span class="summary-value">0</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total</span>
                        <span class="summary-value">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Poro Gold Icon">
                            0
                        </span>
                    </div>
                    <button type="button" class="clear-cart-btn">Vider le panier</button>
                </div>
                <div class="button-con-insc">
                    <img type="submit" src="/Projet-PHP-B2/assets/img/logos/find_match_default.png" alt="Acheter" >
                    <a class="texte-con-insc" >Commander</a>
                </div>
            </div>            
        </main>

        <!-- SECTION DE DROITE AVEC LES DÉTAILS DE L'OBJET -->
        <div class="shop-details-panel">
            <div class="builds-into">
                <h4>DÉBLOQUE</h4>
                <div class="builds-into-grid">
                    <div class="item-square"></div>
                    <div class="item-square"></div>
                    <div class="item-square"></div>
                    <div class="item-square"></div>
                    <div class="item-square"></div>
                    <div class="item-square"></div>
                    <div class="item-square"></div>
                </div>
            </div>

            <div class="big-item-display">
                <div class="item-square-big-item"></div>
            </div>

            <div class="selected-item-info">
                <div class="item-info-header">
                    <div class="item-square-little-item" id="details-img-container"></div>
                    <div class ="item-header-text">
                        <h2 id="details-name">Sélectionnez un item</h2>
                        <div class="price">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Poro Gold Icon">
                            <p class="gold-cost" id="details-price">-</p>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <p class="stats" id="details-desc">Cliquez sur un item à gauche pour voir ses détails.</p>
                    <p class="passive" id="details-id" style="display:none;">ID: -</p>
                </div>
            </div>

            <button class="btn-purchase" style="visibility:hidden">ACHETER</button>
        </div>

    </div>
    <footer>
        <p>© 2026 Antre du Poro. Tous droits réservés.</p> 
    </footer>
<script src="/Projet-PHP-B2/assets/js/admin.js" defer></script>
</body>
</html>