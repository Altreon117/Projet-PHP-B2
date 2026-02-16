<?php
/**
 * Page panier (panier.php).
 *
 * Gère l'affichage des articles ajoutés au panier par l'utilisateur.
 * Permet de visualiser le total, de vider le panier ou de passer commande.
 */
require_once 'core/db.php';

$userFavorites = [];
if (isset($_SESSION['user_id'])) {
    $stmtFav = $pdo->prepare("SELECT id_item FROM user_favorites WHERE id_user = ?");
    $stmtFav->execute([$_SESSION['user_id']]);
    $userFavorites = $stmtFav->fetchAll(PDO::FETCH_COLUMN);
}

$panier = $_SESSION['panier'] ?? [];
$items = [];
$total = 0;

if (!empty($panier)) {
    $ids = implode(',', array_map('intval', array_keys($panier)));
    $stmt = $pdo->query("SELECT * FROM items WHERE id IN ($ids)");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$userFavorites = [];
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT id_item FROM user_favorites WHERE id_user = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $userFavorites = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>
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
        <div class="shop-sidebar-left">
            <div class="profile-section">
                <a href="connexion.php" class="profile-icon">
                    <img src="assets/img/logos/lol_icon.png" alt="Profil Icon">
                </a>
            </div>
            <div class="sidebar-block-consumables">
                <?php
$stmt = $pdo->query("SELECT * FROM items WHERE categorie = 'consumable'");
while ($item = $stmt->fetch()) {
    echo '<div class="mini-icon" onclick="selectItem(this)"
                            data-id="' . htmlspecialchars($item['id']) . '"
                            data-name="' . htmlspecialchars($item['nom']) . '"
                            data-price="' . (int)$item['prix'] . '"
                            data-stats="' . htmlspecialchars($item['description_stat'] . ' ' . $item['description_passive']) . '">
                            <img class="item-square" src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['nom']) . '">
                            <a>' . (int)$item['prix'] . '</a>
                          </div>';
}
?>
            </div>
            
            <div class="sidebar-block-boots">
                <?php
$stmt = $pdo->query("SELECT * FROM items WHERE categorie = 'boots'");
while ($item = $stmt->fetch()) {
    echo '<div class="mini-icon" onclick="selectItem(this)"
                            data-id="' . htmlspecialchars($item['id']) . '"
                            data-name="' . htmlspecialchars($item['nom']) . '"
                            data-price="' . (int)$item['prix'] . '"
                            data-stats="' . htmlspecialchars($item['description_stat'] . ' ' . $item['description_passive']) . '">
                            <img class="item-square" src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['nom']) . '">
                            <a>' . (int)$item['prix'] . '</a>
                          </div>';
}
?>
            </div>
        </div>

        <main class="shop-main-content">
            <div class="shop-tabs">
                <a href="index.php" >ACCUEIL</a>
                <a href="all-items.php" >TOUS LES OBJETS</a>
                <a href="panier.php" id="active">PANIER</a>
            </div>
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
            </div>
            <div class="panier-section">
                <div class="item-spot-section">
                    <?php
$inventorySlots = array_fill(0, 6, null);
$trinketSlot = null;
$trinketNames = ['farsight alteration', 'oracle lens', 'stealth ward'];

$orderedItems = [];
if (!empty($panier)) {
    foreach ($panier as $pId => $pQty) {
        foreach ($items as $dbItem) {
            if ($dbItem['id'] == $pId) {
                $isTrinket = ($dbItem['role'] === 'Balise');

                if ($isTrinket) {
                    if ($trinketSlot === null) {
                        $trinketSlot = $dbItem;
                    }
                }
                else {
                    $orderedItems[] = $dbItem;
                }
                break;
            }
        }
    }
}

$slotIndex = 0;
foreach ($orderedItems as $item) {
    if ($slotIndex < 6) {
        $inventorySlots[$slotIndex] = $item;
        $slotIndex++;
    }
}
?>
                    <div class="item6-spot">
                        <?php for ($i = 0; $i < 6; $i++): ?>
                            <div class="item-spot">
                                <?php if (!empty($inventorySlots[$i]) && is_array($inventorySlots[$i])): ?>
                                    <img src="<?php echo htmlspecialchars($inventorySlots[$i]['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($inventorySlots[$i]['nom']); ?>"
                                         style="width:100%; height:100%; object-fit:contain;">
                                <?php
    endif; ?>
                            </div>
                        <?php
endfor; ?>
                    </div>
                    <div class="item7-trinket-spot">
                        <div class="item-spot">
                             <?php if (!empty($trinketSlot) && is_array($trinketSlot)): ?>
                                <img src="<?php echo htmlspecialchars($trinketSlot['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($trinketSlot['nom']); ?>"
                                     style="width:100%; height:100%; object-fit:contain;">
                            <?php
endif; ?>
                        </div>
                    </div>
                </div>
                <div class="others-items-spot">
                    <?php
$id_counter = 0;
if (empty($items)) {
    echo '<p style="color:white; padding:20px;">Votre panier est vide.</p>';
}
else {
    $sortedItems = [];
    foreach ($panier as $pId => $qty) {
        foreach ($items as $item) {
            if ($item['id'] == $pId) {
                $sortedItems[] = $item;
                break;
            }
        }
    }

    foreach ($sortedItems as $item) {
        $qty = $panier[$item['id']];
        $subtotal = $item['prix'] * $qty;
        $total += $subtotal;
        $id_counter++;

        echo '<div class="cart-item-row" onclick="selectItem(this)"
                data-id="' . htmlspecialchars($item['id']) . '"
                data-name="' . htmlspecialchars($item['nom']) . '"
                data-price="' . (int)$item['prix'] . '"
                data-stats="' . str_replace(["\r\n", "\r", "\n"], '<br>', htmlspecialchars($item['description_stat'])) . '<br><br>' . str_replace(["\r\n", "\r", "\n"], '<br>', htmlspecialchars($item['description_passive'])) . '"
                data-fav="' . (in_array($item['id'], $userFavorites ?? []) ? 'true' : 'false') . '">
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
                    <a class="texte-con-insc" >Commander</a>
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
                     <img id="fav-btn" class="fav-icon-btn" src="assets/img/logos/favorite.png" alt="Favori">
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
                    <div class="item-square-little-item"></div>
                    <div class ="item-header-text">
                        <h2 id="details-name">Sélectionnez un objet</h2>
                        <div class="price">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Poro Gold Icon">
                            <p class="gold-cost" id="details-price">-</p>
                        </div>
                    </div>
                </div>

                <div class="description">
                    <p class="stats" id="details-stats">Stats...</p>
                    <p class="passive">Passive: ...</p>
                </div>
            </div>

            <button class="btn-purchase">ACHETER</button>
        </div>

    </div>
    <footer>
        <p>© 2026 Antre du Poro. Tous droits réservés.</p> 
    </footer>

    <script src="/Projet-PHP-B2/assets/js/cart.js" defer></script>
    <script src="/Projet-PHP-B2/assets/js/shop.js" defer></script>
    <script src="/Projet-PHP-B2/assets/js/search.js" defer></script>
    <script>
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