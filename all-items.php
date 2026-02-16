<?php
/**
 * Page catalogue publique (all-items.php).
 *
 * Affiche la liste complète des objets avec des filtres par rôle et par statistiques.
 * Permet de consulter les détails survolés et d'ajouter au panier.
 */
require_once 'core/db.php'; ?>
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
            data-stats="' . htmlspecialchars($item['description']) . '">
            <img class="item-square" src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['nom']) . '">
            <a>' . (int)$item['prix'] . '</a>
          </div>';
}
?>
                 <div class="mini-icon">
                    <div class="item-square" style="visibility: hidden;"></div>
                </div>
            </div>
            
            <div class="sidebar-block-boots">
                <?php
$stmt = $pdo->query("SELECT * FROM items WHERE categorie = 'boots'");
while ($item = $stmt->fetch()) {
    echo '<div class="mini-icon" onclick="selectItem(this)"
            data-id="' . htmlspecialchars($item['id']) . '"
            data-name="' . htmlspecialchars($item['nom']) . '"
            data-price="' . (int)$item['prix'] . '"
            data-stats="' . htmlspecialchars($item['description']) . '">
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
                <a href="all-items.php" id="active">TOUS LES OBJETS</a>
                <a href="panier.php">PANIER</a>
            </div>
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
                <div class="horizontal-filter-section">
                    <div class="filter-square-horizontal" id="filter-all-logo" data-filter-value="all">
                        <?php
for ($i = 0; $i < 9; $i++) {
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
                </div>
            </div>

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
$stmt = $pdo->query("SELECT * FROM items");
while ($item = $stmt->fetch()) {
    $role = strtolower($item['categorie']);
    $stats = strtolower($item['description']);

    echo '<div class="item-square" onclick="selectItem(this)"
            data-role="' . htmlspecialchars($role) . '" 
            data-stats="' . htmlspecialchars($stats) . '"
            data-id="' . htmlspecialchars($item['id']) . '"
            data-name="' . htmlspecialchars($item['nom']) . '"
            data-price="' . (int)$item['prix'] . '"
          >' . ($item['image'] ? '<img src="' . htmlspecialchars($item['image']) . '" style="width:100%;height:100%;object-fit:contain;">' : '') . '</div>';
}
?>
                </div>
            </div>
        </main>

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
<script>
document.addEventListener('DOMContentLoaded', function() {


    const roleFilters = document.querySelectorAll('.filter-square-horizontal[data-filter-value]');
    
    roleFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter-value');
            const allFilter = document.querySelector('.filter-square-horizontal[data-filter-value="all"]');
            
            if (filterValue === 'all') {
                if (this.classList.contains('selected-filter')) {
                    this.classList.remove('selected-filter');
                } else {
                    roleFilters.forEach(f => f.classList.remove('selected-filter'));
                    this.classList.add('selected-filter');
                }
            } else {
                const currentSelected = document.querySelector('.filter-square-horizontal.selected-filter[data-filter-value]');
                
                if (currentSelected && currentSelected.getAttribute('data-filter-value') === filterValue) {
                    roleFilters.forEach(f => f.classList.remove('selected-filter'));
                    allFilter.classList.add('selected-filter');
                } else {
                    roleFilters.forEach(f => f.classList.remove('selected-filter'));
                    this.classList.add('selected-filter');
                }
            }
            updateGrid();
        });
    });

    const statFilters = document.querySelectorAll('.filter-square-vertical');
    
    statFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            if (this.id === 'filter-clear') {
                statFilters.forEach(f => f.classList.remove('selected-filter'));
                roleFilters.forEach(f => f.classList.remove('selected-filter'));
                document.querySelector('.filter-square-horizontal[data-filter-value="all"]').classList.add('selected-filter');
            } else {
                this.classList.toggle('selected-filter');
            }
            updateGrid();
        });
    });

    document.querySelector('.filter-square-horizontal[data-filter-value="all"]').classList.add('selected-filter');

    function updateGrid() {
        const activeRoleBtn = document.querySelector('.filter-square-horizontal.selected-filter[data-filter-value]');
        const activeRole = activeRoleBtn ? activeRoleBtn.getAttribute('data-filter-value') : null;

        const activeStatBtns = document.querySelectorAll('.filter-square-vertical.selected-filter[data-filter-value]');
        const activeStats = Array.from(activeStatBtns).map(btn => btn.getAttribute('data-filter-value'));

        const items = document.querySelectorAll('.items-grid .item-square[data-role]');
        
        items.forEach(item => {
            const itemRole = item.getAttribute('data-role');
            const itemStats = item.getAttribute('data-stats');

            const roleMatch = !activeRole || activeRole === 'all' || itemRole === activeRole;

            const statsMatch = activeStats.every(stat => itemStats.includes(stat));

            if (roleMatch && statsMatch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
});
</script>

</body>
</html>