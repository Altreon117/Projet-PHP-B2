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
            <div class="sidebar-block-admin">
                <a href="gestion_user.php">Gestion utilisateur</a>
            </div>
        </div>

        <!-- SECTION PRINCIPALE AVEC LES OBJETS -->
        <main class="shop-main-content">
            <!-- NAVIGATION -->
            <div class="shop-tabs">
                <a href="index_admin.php" >ACCUEIL</a>
                <a href="all-items_admin.php" id="active">TOUS LES OBJETS</a>
                <a href="panier_admin.php">PANIER</a>
            </div>
            <!-- BARRE DE RECHERCHE ET FILTRE HORIZONTALE -->
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
                <div class="horizontal-filter-section">
                    <div class="filter-square-horizontal" id="filter-all-logo" data-filter-value="all">
                        <!-- 9carré pour formler un logo cube -->
                        <?php 
                            for($i=0; $i<9; $i++) {
                            echo '<div class="filter-square-horizontal-all-logo"></div>';
                        }
                        ?>
                    </div>
                    <img class="filter-square-horizontal" data-filter-value="favorite" src="assets/img/logos/favorite.png" alt="Favorite">
                    <img class="filter-square-horizontal" data-filter-value="fighter" src="assets/img/logos/Legendary_Fighter_Item_item.png" alt="Fighter">
                    <img class="filter-square-horizontal" data-filter-value="marksman" src="assets/img/logos/Legendary_Marksman_Item_item.png" alt="Marksman">
                    <img class="filter-square-horizontal" data-filter-value="assassin" src="assets/img/logos/Legendary_Assassin_Item_item.png" alt="Assassin">
                    <img class="filter-square-horizontal" data-filter-value="mage" src="assets/img/logos/Legendary_Mage_Item_item.png" alt="Mage">
                    <img class="filter-square-horizontal" data-filter-value="tank" src="assets/img/logos/Legendary_Tank_Item_item.png" alt="Tank">
                    <img class="filter-square-horizontal" data-filter-value="support" src="assets/img/logos/Legendary_Support_Item_item.png" alt="Support">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Tank_Item_item.png" alt="Tank" style="visibility: hidden;">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Tank_Item_item.png" alt="Tank" style="visibility: hidden;">
                    <img class="filter-square-horizontal" src="assets/img/logos/Legendary_Tank_Item_item.png" alt="Tank" style="visibility: hidden;">
                    <a href="all-items_admin_new.php" class="filter-square-no-hover">
                        <img src="assets/img/logos/rp-top-up-nav-resting.svg" alt="New Item">
                    </a>
                </div>
            </div>

            <!-- FILTRE VERTICAL ET GRILLE D'OBJETS -->
            <div class="filter-objects-container">
                <div class="vertical-filter-section">
                    <img class="filter-square-vertical" id="filter-clear" src="assets/img/logos/cancel.png" alt="Clear Filter">
                    <div class="AD">
                        <img class="filter-square-vertical" data-filter-value="ad" src="assets/img/logos/Attack_damage_icon.png" alt="Attack Damage">
                        <img class="filter-square-vertical" data-filter-value="crit" src="assets/img/logos/Critical_strike_chance_icon.png" alt="Critical Strike Chance">
                        <img class="filter-square-vertical" data-filter-value="attackspeed" src="assets/img/logos/Attack_speed_icon.png" alt="Attack Speed">
                        <img class="filter-square-vertical" data-filter-value="lifesteal" src="assets/img/logos/Life_steal_icon.png" alt="Life Steal">
                        <img class="filter-square-vertical" data-filter-value="arpenpen" src="assets/img/logos/Armor_penetration_icon.png" alt="Armor Penetration">
                    </div>
                    <div class="AP">
                        <img class="filter-square-vertical" data-filter-value="ap" src="assets/img/logos/Ability_power_icon.png" alt="Ability Power">
                        <img class="filter-square-vertical" data-filter-value="mana" src="assets/img/logos/Mana_icon.png" alt="Mana">
                        <img class="filter-square-vertical" data-filter-value="magpen" src="assets/img/logos/Magic_penetration_icon.png" alt="Magic Penetration">
                    </div>
                    <div class="Resistances">
                        <img class="filter-square-vertical" data-filter-value="health" src="assets/img/logos/Health_icon.png" alt="Health">
                        <img class="filter-square-vertical" data-filter-value="healthregen" src="assets/img/logos/Health_regeneration_icon.png" alt="Health Regeneration">
                        <img class="filter-square-vertical" data-filter-value="armor" src="assets/img/logos/Armor_icon.png" alt="Armor">
                        <img class="filter-square-vertical" data-filter-value="magres" src="assets/img/logos/Magic_resistance_icon.png" alt="Magic Resistance">
                        <img class="filter-square-vertical" data-filter-value="tenacity" src="assets/img/logos/Tenacity_icon.png" alt="Tenacity">
                    </div>
                    <div class="Effects">
                        <img class="filter-square-vertical" data-filter-value="cdr" src="assets/img/logos/Cooldown_reduction_icon.png" alt="Cooldown Reduction">
                        <img class="filter-square-vertical" data-filter-value="movespeed" src="assets/img/logos/Movement_speed_icon.png" alt="Movement Speed">
                        <img class="filter-square-vertical" data-filter-value="omnivamp" src="assets/img/logos/Omnivamp_icon.png" alt="Omnivamp">
                    </div>
                </div>
                <div class="items-grid">
                    <?php 
                    // Items avec roles et stats pour le filtrage
                    $items = [
                        ['role' => 'fighter', 'stats' => 'ad health armor'],
                        ['role' => 'marksman', 'stats' => 'ad crit attackspeed'],
                        ['role' => 'assassin', 'stats' => 'ad movespeed arpenpen'],
                        ['role' => 'mage', 'stats' => 'ap mana magpen cdr'],
                        ['role' => 'tank', 'stats' => 'health armor magres tenacity'],
                        ['role' => 'support', 'stats' => 'health cdr mana'],
                    ];
                    
                    // Remplissage pour atteindre 220 items
                    while(count($items) < 220) {
                        $items[] = $items[count($items) % 6];
                    }
                    
                    foreach($items as $item) {
                        $role = strtolower($item['role']);
                        $stats = strtolower($item['stats']);
                        echo '<div class="item-square" data-role="' . $role . '" data-stats="' . $stats . '"></div>';
                    }
                    ?>
                </div>
            </div>
        </main>

        <!-- SECTION DE DROITE AVEC LES DÉTAILS DE L'OBJET -->
        <div class="shop-details-panel">
            <div class="builds-into">
                <div class="title-builds-into" >
                    <h4>DÉBLOQUE</h4>
                    <p></p>
                    <a href="all-items_admin_modif.php" class="edit-link">
                        <img src="assets/img/logos/pen.png" alt="Edit-Icon" >
                    </a>
                    <img src="assets/img/logos/trash.svg" alt="Trash-Icon" class="trash-icon">
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

<script>
document.addEventListener('DOMContentLoaded', function() {

    // 1. GESTION DES FILTRES HORIZONTAUX (Rôles) - Type "Radio"
    const roleFilters = document.querySelectorAll('.filter-square-horizontal[data-filter-value]');
    
    roleFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter-value');
            const allFilter = document.querySelector('.filter-square-horizontal[data-filter-value="all"]');
            
            if (filterValue === 'all') {
                // Click on "all" - toggle it
                if (this.classList.contains('selected-filter')) {
                    this.classList.remove('selected-filter');
                } else {
                    roleFilters.forEach(f => f.classList.remove('selected-filter'));
                    this.classList.add('selected-filter');
                }
            } else {
                // Click on a specific role
                const currentSelected = document.querySelector('.filter-square-horizontal.selected-filter[data-filter-value]');
                
                if (currentSelected && currentSelected.getAttribute('data-filter-value') === filterValue) {
                    // Same role clicked - switch to "all"
                    roleFilters.forEach(f => f.classList.remove('selected-filter'));
                    allFilter.classList.add('selected-filter');
                } else {
                    // Different role - select it, deselect "all"
                    roleFilters.forEach(f => f.classList.remove('selected-filter'));
                    this.classList.add('selected-filter');
                }
            }
            updateGrid();
        });
    });

    // 2. GESTION DES FILTRES VERTICAUX (Stats) - Type "Checkbox"
    const statFilters = document.querySelectorAll('.filter-square-vertical');
    
    statFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            // Cas spécial pour le bouton "Croix" (Clear all)
            if (this.id === 'filter-clear') {
                statFilters.forEach(f => f.classList.remove('selected-filter'));
                roleFilters.forEach(f => f.classList.remove('selected-filter'));
                document.querySelector('.filter-square-horizontal[data-filter-value="all"]').classList.add('selected-filter');
            } else {
                // Comportement normal : on active/désactive simplement (pas d'exclusion mutuelle)
                this.classList.toggle('selected-filter');
            }
            updateGrid(); // On lance le tri
        });
    });

    // Initialize with "all" selected
    document.querySelector('.filter-square-horizontal[data-filter-value="all"]').classList.add('selected-filter');

    // 3. LA FONCTION DE TRI (Le Cerveau)
    function updateGrid() {
        // A. Récupérer le rôle actif (s'il y en a un)
        const activeRoleBtn = document.querySelector('.filter-square-horizontal.selected-filter[data-filter-value]');
        const activeRole = activeRoleBtn ? activeRoleBtn.getAttribute('data-filter-value') : null;

        // B. Récupérer toutes les stats actives
        const activeStatBtns = document.querySelectorAll('.filter-square-vertical.selected-filter[data-filter-value]');
        const activeStats = Array.from(activeStatBtns).map(btn => btn.getAttribute('data-filter-value'));

        // C. Parcourir tous les items
        const items = document.querySelectorAll('.items-grid .item-square[data-role]');
        
        items.forEach(item => {
            const itemRole = item.getAttribute('data-role');
            const itemStats = item.getAttribute('data-stats'); // ex: "ap mana magpen cdr"

            // Condition 1 : Est-ce que le rôle correspond ? (ou aucun rôle sélectionné)
            const roleMatch = !activeRole || activeRole === 'all' || itemRole === activeRole;

            // Condition 2 : Est-ce que l'item possède TOUTES les stats cochées ?
            const statsMatch = activeStats.every(stat => itemStats.includes(stat));

            // Résultat
            if (roleMatch && statsMatch) {
                item.style.display = 'block'; // Affiche
            } else {
                item.style.display = 'none';  // Cache
            }
        });
    }
});
</script>

</body>
</html>