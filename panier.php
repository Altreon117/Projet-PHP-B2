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

                <div class="mini-icon">
                    <div class="item-square" style="visibility: hidden;"></div>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/40px-Refillable_Potion_item.png" alt="Refillable Potion">
                    <a>150</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/Health_Potion_item.png" alt="Health Potion">
                    <a>50</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/Farsight_Alteration_item.png" alt="Farsight Alteration">
                    <a>Gratuit</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/Oracle_Lens_item.png" alt="Oracle Lens">
                    <a>Gratuit</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/Stealth_Ward_item.png" alt="Stealth Ward">
                    <a>Gratuit</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/Elixir_of_Iron_item.png" alt="Elixir of Iron">
                    <a>500</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/Elixir_of_Wrath_item.png" alt="Elixir of Wrath">
                    <a>500</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/Elixir_of_Sorcery_item.png" alt="Elixir of Sorcery">
                    <a>500</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square" style="visibility: hidden;"></div>
                </div>
                <div class="mini-icon">
                    <div class="item-square" style="visibility: hidden;"></div>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/consumables/Control_Ward_item.png" alt="Control Ward">
                    <a>75</a>
                </div>
            </div>
            
            <!-- BOTTES -->
            <div class="sidebar-block-boots">
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Boots_of_Swiftness_item.png" alt="Boots of Swiftness">
                    <a>1000</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Berserker_s_Greaves_item.png" alt="Berserker's Greaves">
                    <a>1100</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Boots_item.png" alt="Boots">
                    <a>300</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Mercury_s_Treads_item.png" alt="Mercury's Treads">
                    <a>1250</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Chainlaced_Crushers_item.png" alt="Chainlaced Crushers">
                    <a>1250</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Sorcerer_s_Shoes_item.png" alt="Sorcerer's Shoes">
                    <a>1100</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Plated_Steelcaps_item.png" alt="Plated Steelcaps">
                    <a>1200</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Armored_Advance_item.png" alt="Armored Advance">
                    <a>1200</a>
                </div>
                <div class="mini-icon">
                    <img class="item-square" src="assets/img/boots/Ionian_Boots_of_Lucidity_item.png" alt="Ionian Boots of Lucidity">
                    <a>900</a>
                </div>
            </div>
        </div>

        <!-- SECTION PRINCIPALE AVEC LES OBJETS -->
        <main class="shop-main-content">
            <!-- NAVIGATION -->
            <div class="shop-tabs">
                <a href="index.php" >ACCUEIL</a>
                <a href="all-items.php" >TOUS LES OBJETS</a>
                <a href="panier.php" id="active">PANIER</a>
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
$cartItems = [
    ['name' => 'Potion de soin', 'price' => 50, 'img' => 'assets/img/consumables/Health_Potion_item.png', 'qty' => 3],
    ['name' => 'Bottes de vitesse', 'price' => 300, 'img' => 'assets/img/boots/Boots_item.png', 'qty' => 1],
    ['name' => 'Coiffe de Rabadon', 'price' => 3600, 'img' => 'assets/img/logos/Legendary_Mage_Item_item.png', 'qty' => 1],
];

foreach ($cartItems as $index => $item) {
    $id = 'cart_item_' . $index;
    echo '<div class="cart-item-row" data-id="' . $id . '" data-price="' . $item['price'] . '">
                                <div class="cart-item-info">
                                    <div class="cart-item-img-container">
                                        <img src="' . $item['img'] . '" alt="' . $item['name'] . '" class="cart-item-img">
                                    </div>
                                    <div class="cart-item-details">
                                        <span class="cart-item-name">' . $item['name'] . '</span>
                                        <span class="cart-item-unit-price">' . $item['price'] . ' PO</span>
                                    </div>
                                </div>
                                <div class="cart-item-actions">
                                    <button class="qty-btn minus" data-action="decrease">-</button>
                                    <input type="number" class="qty-input" value="' . $item['qty'] . '" min="1" readonly>
                                    <button class="qty-btn plus" data-action="increase">+</button>
                                    <span class="cart-item-total-price">' . ($item['price'] * $item['qty']) . ' PO</span>
                                    <button class="remove-btn" title="Retirer">X</button>
                                </div>
                            </div>';
}
?>
                </div>
                <div class="panier-summary">
                    <div class="summary-row">
                        <span class="summary-label">Articles</span>
                        <span class="summary-value" id="cart-total-count">0</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total</span>
                        <span class="summary-value">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Poro Gold Icon">
                            <span id="cart-total-price">0</span>
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
                    <div class="item-square-little-item"></div>
                    <div class ="item-header-text">
                        <h2>Coiffe de Rabadon</h2>
                        <div class="price">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Poro Gold Icon">
                            <p class="gold-cost">3600</p>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <p class="stats">+ 120 Ability Power</p>
                    <p class="passive">Passive: Increases AP by 35%    
                        fezfezzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz
                        eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
                        eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
                    </p>
                </div>
            </div>

            <button class="btn-purchase">ACHETER</button>
        </div>

    </div>
    <footer>
        <p>© 2026 Antre du Poro. Tous droits réservés.</p> 
    </footer>

    <script src="/Projet-PHP-B2/assets/js/cart-interactions.js" defer></script>
</body>
</html>