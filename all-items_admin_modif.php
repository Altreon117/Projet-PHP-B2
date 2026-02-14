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
                <a href="all-items.php" id="active">TOUS LES OBJETS</a>
                <a href="panier.php">PANIER</a>
            </div>
            <!-- BARRE DE RECHERCHE ET FILTRE HORIZONTALE -->
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
                <div class="horizontal-filter-section">
                    <div class="filter-square-horizontal" id="filter-all-logo">
                        <!-- 9carré pour formler un logo cube -->
                        <?php 
                            for($i=0; $i<9; $i++) {
                            echo '<div class="filter-square-horizontal-all-logo"></div>';
                        }
                        ?>
                    </div>
                    <img class="filter-square-horizontal" src="assets/img/logos/favorite.png" alt="Favorite">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Fighter_Item_item.png" alt="Fighter">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Marksman_Item_item.png" alt="Marksman">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Assassin_Item_item.png" alt="Assassin">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Mage_Item_item.png" alt="Mage">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Tank_Item_item.png" alt="Tank">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Support_Item_item.png" alt="Support">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Tank_Item_item.png" alt="Tank" style="visibility: hidden;">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Tank_Item_item.png" alt="Tank" style="visibility: hidden;">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Tank_Item_item.png" alt="Tank" style="visibility: hidden;">
                    <img class="filter-square-horizontal" src="assets/img/logos/rp-top-up-nav-resting.svg" alt="New Item" style="background: hidden; border: none;" href="all-items_admin_modif.php">
                </div>
            </div>

            <!-- FILTRE VERTICAL ET GRILLE D'OBJETS -->
            <div class="filter-objects-container">
                <div class="vertical-filter-section">
                    <img class="filter-square-vertical" id="filter-clear" src="assets/img/logos/cancel.png" alt="Clear Filter">
                    <div class="AD">
                        <img class="filter-square-vertical" src="assets/img/logos/Attack_damage_icon.png" alt="Attack Damage">
                        <img class="filter-square-vertical" src="assets/img/logos/Critical_strike_chance_icon.png" alt="Critical Strike Chance">
                        <img class="filter-square-vertical" src="assets/img/logos/Attack_speed_icon.png" alt="Attack Speed">
                        <img class="filter-square-vertical" src="assets/img/logos/Life_steal_icon.png" alt="Life Steal">
                        <img class="filter-square-vertical" src="assets/img/logos/Armor_penetration_icon.png" alt="Armor Penetration">
                    </div>
                    <div class="AP">
                        <img class="filter-square-vertical" src="assets/img/logos/Ability_power_icon.png" alt="Ability Power">
                        <img class="filter-square-vertical" src="assets/img/logos/Mana_icon.png" alt="Mana">
                        <img class="filter-square-vertical" src="assets/img/logos/Magic_penetration_icon.png" alt="Magic Penetration">
                    </div>
                    <div class="Resistances">
                        <img class="filter-square-vertical" src="assets/img/logos/Health_icon.png" alt="Health">
                        <img class="filter-square-vertical" src="assets/img/logos/Health_regeneration_icon.png" alt="Health Regeneration">
                        <img class="filter-square-vertical" src="assets/img/logos/Armor_icon.png" alt="Armor">
                        <img class="filter-square-vertical" src="assets/img/logos/Magic_resistance_icon.png" alt="Magic Resistance">
                        <img class="filter-square-vertical" src="assets/img/logos/Tenacity_icon.png" alt="Tenacity">
                    </div>
                    <div class="Effects">
                        <img class="filter-square-vertical" src="assets/img/logos/Cooldown_reduction_icon.png" alt="Cooldown Reduction">
                        <img class="filter-square-vertical" src="assets/img/logos/Movement_speed_icon.png" alt="Movement Speed">
                        <img class="filter-square-vertical" src="assets/img/logos/Omnivamp_icon.png" alt="Omnivamp">
                    </div>
                </div>
                <div class="items-grid">
                    <?php 
                    // Petite boucle PHP pour simuler plein d'objets et voir la grille
                    for($i=0; $i<220; $i++) {
                        echo '<div class="item-square"></div>';
                    }
                    ?>
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

</body>
</html>