<?php
/**
 * Page d'accueil publique (index.php).
 *
 * Affiche les produits phares, les dernières actualités et permet la navigation vers la boutique.
 * Intègre le système de filtres et d'ajout au panier.
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
                <a href="index.php" id="active">ACCUEIL</a>
                <a href="all-items.php" >TOUS LES OBJETS</a>
                <a href="panier.php">Panier</a>
            </div>
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
            </div>

            <div class="main-content-page">
                <header>ANTRE DU PORO</header>
                <h1>Bienvenue Dans L'Antre Du Poro</h1>
                <p class="intro">Découvrez les objets les plus populaires et les meilleures offres pour votre champion préféré !
                Avec l'Antre du Poro, découvrez tous les détails des objets, comparez les builds et préparez-vous à dominer la Faille de l'Invocateur !</p>
                </p>
                <h2> OBJETS LES PLUS ACHETÉS</h2>
                <div class="recommended-items-section">
                    <?php
$stmt = $pdo->query("SELECT * FROM items ORDER BY RAND() LIMIT 3");
$topItems = $stmt->fetchAll();
$ranks = [['icon' => 'ktranscendent.svg', 'label' => 'N°1'], ['icon' => 'kexalted.svg', 'label' => 'N°2'], ['icon' => 'kultimate.svg', 'label' => 'N°3']];

foreach ($topItems as $index => $item) {
    $rank = $ranks[$index] ?? ['icon' => 'ktranscendent.svg', 'label' => 'N°' . ($index + 1)];
    echo '<div class="recommended-item">
                            <div class="rank">
                                <img class="ranked-item-icon" src="assets/img/logos/' . $rank['icon'] . '" alt="Rank">
                                <p class="rank-number">' . $rank['label'] . '</p>
                            </div>
                            <div class="item-square-middle-item">
                                ' . ($item['image'] ? '<img src="' . htmlspecialchars($item['image']) . '" style="width:100%;height:100%;object-fit:contain;">' : '') . '
                            </div>
                            <h1 class="item-name">' . htmlspecialchars($item['nom']) . '</h1>
                            <h1 class="sold-number">Vendu ' . rand(100, 5000) . ' fois</h1>
                        </div>';
}
?>
                </div>
                <div class="news-section">
                    <h2 class="news-title">DERNIÈRES ANNONCES</h2>
                    <div class="news-articles">
                        <article class="news-article">
                            <div class="article-video-container">
                                <iframe 
                                    width="560" 
                                    height="315" 
                                    src="https://www.youtube.com/embed/-pvUbeV119Y" 
                                    title="YouTube video player" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Le renouveau du printemps : L'amitié fleurit sur la Faille au Patch 26.03</h3>
                                <p class="article-description">Dévoilé le 04 février 2026, cette annonce marque le retour du Festival Lunaire avec une esthétique poétique. Le trailer souligne que « l'amitié renaît au premier souffle du printemps », introduisant une première vague de festivités dès le patch 26.03. La grosse annonce concerne la suite : au patch 26.04, une collection complète de skins « Pétales de Printemps » sera disponible pour Yasuo, Katarina, Jayce, Camille et Lillia. C'est également à cette occasion que les cartes de « Votre Boutique » ont été mises à jour avec un design floral et printanier.</p>
                            </div>
                        </article>
                        <article class="news-article">
                            <div class="article-video-container">
                                <iframe 
                                    width="560" 
                                    height="315" 
                                    src="https://www.youtube.com/embed/e3D7Fj1PsWk" 
                                    title="YouTube video player" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Salvation : L'espoir de Demacia face à l'obscurité (Cinématique Saison 1)</h3>
                                <p class="article-description">Sortie le 07 janvier 2026, cette cinématique épique portée par le titre « Salvation » (en featuring avec Forts) a lancé officiellement le premier Split de l'année. Elle met en scène une Demacia au bord du gouffre, illustrant le sacrifice héroïque de Xin Zhao et l'intervention de Quinn, Sona et Shyvana pour protéger le royaume contre une invasion imminente. Plus qu'une simple vidéo, ce trailer pose les bases narratives de l'année 2026, confirmant le thème de la « Justice » et de la « Lumière » qui imprègne actuellement la Faille de l'Invocateur.</p>
                            </div>
                        </article>
                        <article class="news-article">
                            <div class="article-video-container">
                                <iframe 
                                    width="560" 
                                    height="315" 
                                    src="https://www.youtube.com/embed/xqlxrOuVxxE" 
                                    title="YouTube video player" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">La Révolution du Gameplay : Les Quêtes de Rôle</h3>
                                <p class="article-description">Publiée le 01 décembre 2025 pour préparer le terrain, cette mise à jour des développeurs a révélé les changements structurels les plus profonds de l'histoire du jeu. Riot y a présenté les « Quêtes de Rôle », un système permettant notamment aux ADC de débloquer un 7ème emplacement d'inventaire dédié aux bottes après avoir accompli leurs objectifs. L'annonce a également détaillé le passage au niveau 20 pour les Toplaners et l'arrivée des bottes de palier 3 pour les Midlaners, définissant ainsi la nouvelle ère stratégique dans laquelle les joueurs évoluent depuis le mois de janvier.</p>
                            </div>
                        </article>
                    </div>
                </div>
                <footer>
                    <a href="credit.php" class="nous-link">Qui sommes-nous ?</a>
                </footer>
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
                        <h2 id="details-name">Sélectionnez un item</h2>
                        <div class="price">
                            <img class="poro-gold-icon" src="assets/img/logos/currency.png" alt="Poro Gold Icon">
                            <p class="gold-cost" id="details-price">-</p>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <p class="stats" id="details-desc">Cliquez sur un item...</p>
                    <p class="passive" style="display:none;">Passive: ...</p>
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
</body>
</html>