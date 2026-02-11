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
            <div class="sidebar-block-consumables">

                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>500</a> 
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>150</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>50</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>Gratuit</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>Gratuit</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>Gratuit</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>500</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>500</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>500</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>75</a>
                </div>
            </div>
            

            <div class="sidebar-block-boots">
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>900</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>900</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>300</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>1000</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>1100</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>1100</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>1100</a>
                </div>
                <div class="mini-icon">
                    <div class="item-square"></div>
                    <a>1100</a>
                </div>
            </div>
        </div>

        <!-- SECTION PRINCIPALE AVEC LES OBJETS -->
        <main class="shop-main-content">
            <!-- NAVIGATION -->
            <div class="shop-tabs">
                <a href="index.php" id="active">CONSEILLÉS</a>
                <a href="all-items.php" >TOUS LES OBJETS</a>
                <a href="item-sets.php">SET D'OBJETS</a>
            </div>
            <!-- BARRE DE RECHERCHE ET FILTRE HORIZONTALE -->
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
                <div class="horizontal-filter-section">
                    <div class="filter-square-horizontal"></div>
                    <div class="filter-square-horizontal"></div>
                    <div class="filter-square-horizontal"></div>
                    <div class="filter-square-horizontal"></div>
                    <div class="filter-square-horizontal"></div>
                    <div class="filter-square-horizontal"></div>
                    <div class="filter-square-horizontal"></div>
                    <div class="filter-square-horizontal"></div>
                </div>
            </div>

            <!-- FILTRE VERTICAL ET GRILLE D'OBJETS -->
            <div class="filter-objects-container">
                <div class="vertical-filter-section">
                    <div class="filter-square-vertical"></div>
                    <div class="AD">
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                    </div>
                    <div class="AP">
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                    </div>
                    <div class="Resistance">
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                    </div>
                    <div class="Effects">
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
                        <div class="filter-square-vertical"></div>
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
                            <div class="poro-gold-icon"></div>
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

</body>