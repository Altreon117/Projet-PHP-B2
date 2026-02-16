<?php
/**
 * Page panier administration (panier_admin.php).
 *
 * Gère l'affichage des articles ajoutés au panier par l'administrateur (simulation user).
 * Permet de visualiser le total, de vider le panier ou de passer commande, 
 * tout en gardant l'accès aux outils d'administration (édition/suppression items via sidebar/panel).
 */
require_once 'core/db.php';
require_once 'core/admin_auth.php'; // Sécurité admin

$panier = $_SESSION['panier'] ?? [];
$items = [];
$total = 0;

if (!empty($panier)) {
    $ids = implode(',', array_map('intval', array_keys($panier)));
    $stmt = $pdo->query("SELECT * FROM items WHERE id IN ($ids)");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antre du Poro - Admin Cart</title>
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
            <div class="sidebar-block-consumables">
                <?php
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
}
catch (PDOException $e) {
    echo "Erreur";
}
?>
            </div>
            
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

        <main class="shop-main-content">
            <div class="shop-tabs">
                <a href="index_admin.php" >ACCUEIL</a>
                <a href="all-items_admin.php" >TOUS LES OBJETS</a>
                <a href="panier_admin.php" id="active">PANIER</a>
            </div>
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
            </div>
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
$id_counter = 0;
if (empty($items)) {
    echo '<p style="color:white; padding:20px;">Votre panier admin est vide.</p>';
}
else {
    foreach ($items as $item) {
        $qty = $panier[$item['id']];
        $subtotal = $item['prix'] * $qty;
        $total += $subtotal;
        $id_counter++;

        // Note: onclick calls adminSelectItem to populate the right panel for admin actions
        echo '<div class="cart-item-row" onclick="adminSelectItem(this)"
                                    data-id="' . htmlspecialchars($item['id']) . '"
                                    data-name="' . htmlspecialchars($item['nom']) . '"
                                    data-price="' . (int)$item['prix'] . '"
                                    data-desc="' . htmlspecialchars($item['description']) . '"
                                    data-img="' . htmlspecialchars($item['image']) . '">
                                            <div class="cart-item-info">
                                                <div class="cart-item-img-container">
                                                    <img src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['nom']) . '" class="cart-item-img">
                                                </div>
                                                <div class="cart-item-details">
                                                    <span class="cart-item-name">' . htmlspecialchars($item['nom']) . '</span>
                                                    <span class="cart-item-unit-price">' . (int)$item['prix'] . ' PO</span>
                                                </div>
                                            </div>
                                            <div class="cart-item-actions">
                                                <button class="qty-btn minus" onclick="event.stopPropagation(); updateQty(' . $item['id'] . ', ' . ($qty - 1) . ')">-</button>
                                                <input type="number" class="qty-input" value="' . $qty . '" readonly onclick="event.stopPropagation()">
                                                <button class="qty-btn plus" onclick="event.stopPropagation(); updateQty(' . $item['id'] . ', ' . ($qty + 1) . ')">+</button>
                                                <span class="cart-item-total-price">' . (int)$subtotal . ' PO</span>
                                                <button class="remove-btn" onclick="event.stopPropagation(); removeFromCart(' . $item['id'] . ')">X</button>
                                            </div>
                                        </div>';
    }
}
?>
                </div>
                <div class="panier-summary">
                    <div class="summary-row">
                        <span class="summary-label">Articles</span>
                        <span class="summary-value" id="cart-total-count"><?php echo array_sum($panier); ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total</span>
                        <span class="summary-value">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Poro Gold Icon">
                            <span id="cart-total-price"><?php echo (int)$total; ?></span>
                        </span>
                    </div>
                    <?php if (!empty($panier)): ?>
                    <button type="button" class="clear-cart-btn" onclick="clearCart()">Vider le panier</button>
                    <?php
endif; ?>
                </div>
                
                <?php if (!empty($panier)): ?>
                <div class="button-con-insc" onclick="document.getElementById('checkout-form').submit();">
                    <img type="submit" src="/Projet-PHP-B2/assets/img/logos/find_match_default.png" alt="Acheter" >
                    <a class="texte-con-insc" >Commander (Test)</a>
                </div>
                <form id="checkout-form" action="core/checkout.php" method="post" style="display:none;"></form>
                <?php
endif; ?>
            </div>            
        </main>

        <div class="shop-details-panel">
            <div class="builds-into">
                <div class="title-builds-into">
                    <h4>DÉBLOQUE</h4>
                    <p></p>
                    <a href="#" class="edit-link">
                        <img src="assets/img/logos/pen.png" alt="Edit-Icon">
                    </a>
                    <img src="assets/img/logos/trash.svg" alt="Trash-Icon" class="trash-icon btn-delete-confirm" id="admin-delete-item-btn" style="cursor: pointer;">
                </div>
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
                    <p class="stats" id="details-desc">Cliquez sur un item pour voir ses détails.</p>
                    <p class="passive" id="details-id" style="display:none;">ID: -</p>
                </div>
            </div>

            <button class="btn-purchase">ACHETER</button>
        </div>

    </div>
    <footer>
        <p>© 2026 Antre du Poro. Tous droits réservés.</p> 
    </footer>
    <script src="/Projet-PHP-B2/assets/js/admin.js" defer></script>
<script src="/Projet-PHP-B2/assets/js/cart.js" defer></script>
    <script>
    // Functions for cart interactions (duplicated/adapted from cart.js for admin context)
    function updateQty(id, qty) {
        fetch('/Projet-PHP-B2/core/cart_actions.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({action: 'update', id: id, quantity: qty})
        }).then(() => location.reload());
    }
    
    function removeFromCart(id) {
        fetch('/Projet-PHP-B2/core/cart_actions.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({action: 'remove', id: id})
        }).then(() => location.reload());
    }

    function clearCart() {
        if(confirm('Vider le panier ?')) {
            fetch('/Projet-PHP-B2/core/cart_actions.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({action: 'clear'})
            }).then(() => location.reload());
        }
    }
    </script>
</body>
</html>