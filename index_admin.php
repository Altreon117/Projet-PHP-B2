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
                <a href="index_admin.php" id="active">ACCUEIL</a>
                <a href="all-items_admin.php" >TOUS LES OBJETS</a>
                <a href="panier_admin.php">PANIER</a>
            </div>
            <!-- BARRE DE RECHERCHE ET FILTRE HORIZONTALE -->
            <div class="search-filters">
                <input type="text" placeholder="Recherchez des objets, des stats ou des mots-clés...">
            </div>

            <!-- Page d'accueil -->
            <div class="main-content-page">
                <header>ANTRE DU PORO</header>
                <h1>Bienvenue Dans L'Antre Du Poro</h1>
                <p class="intro">Découvrez les objets les plus populaires et les meilleures offres pour votre champion préféré !
                Avec l'Antre du Poro, découvrez tous les détails des objets, comparez les builds et préparez-vous à dominer la Faille de l'Invocateur !</p>
                </p>
                <h2> OBJETS LES PLUS ACHETÉS</h2>
                <div class="recommended-items-section">
                    <!--<h2>OBJETS LES PLUS ACHETÉS</h2>-->
                    <div class="recommended-item">
                        <div class="rank">
                            <img class="ranked-item-icon" src="assets/img/logos/kexalted.svg" alt="Exalted rank">
                            <p class="rank-number">N°2</p>
                        </div>
                        <div class="item-square-middle-item"></div>
                        <h1 class="item-name">Name</h1>
                        <h1 class="sold-number">Vendu N fois</h1>
                    </div>
                    <div class="recommended-item">
                        <div class="rank">
                            <img class="ranked-item-icon" src="assets/img/logos/ktranscendent.svg" alt="Transcendant rank">
                            <p class="rank-number">N°1</p>
                        </div>
                        <div class="item-square-middle-item"></div>
                        <h1 class="item-name">Name</h1>
                        <h1 class="sold-number">Vendu N fois</h1>
                    </div>
                    <div class="recommended-item">
                        <div class="rank">
                            <img class="ranked-item-icon" src="assets/img/logos/kultimate.svg" alt="Ultimate rank">
                            <p class="rank-number">N°3</p>
                        </div>
                        <div class="item-square-middle-item"></div>
                        <h1 class="item-name">Name</h1>
                        <h1 class="sold-number">Vendu N fois</h1>
                    </div>
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