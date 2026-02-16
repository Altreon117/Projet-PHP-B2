<!DOCTYPE html>
<?php
/**
 * Page de crédits (credit.php).
 *
 * Affiche les informations sur l'équipe de développement et le projet.
 */
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qui sommes-nous ? - Antre du Poro</title>
    <link rel="stylesheet" href="/Projet-PHP-B2/assets/css/style.css">
    <style>
        .credits-container {
            color: white;
            padding: 50px;
            text-align: center;
        }
        .credits-container h1 {
            color: #c8aa6e;
            margin-bottom: 30px;
        }
        .credits-content {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border: 2px solid #c8aa6e;
            display: inline-block;
            max-width: 800px;
        }
    </style>
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
                <div class="mini-icon"><a href="index.php" style="color:#c8aa6e; text-decoration:none;">Retour</a></div>
            </div>
        </div>

        <main class="shop-main-content">
            <div class="shop-tabs">
                <a href="index.php">ACCUEIL</a>
                <a href="all-items.php">TOUS LES OBJETS</a>
                <a href="panier.php">PANIER</a>
            </div>

            <div class="credits-container">
                <div class="credits-content">
                    <h1>Qui sommes-nous ?</h1>
                    <p>L'Antre du Poro est votre boutique de référence pour tous les objets légendaires de la Faille de l'Invocateur.</p>
                    <br>
                    <p>Développé par une équipe de passionnés, ce projet a pour but de fournir aux invocateurs les meilleurs équipements pour mener leur équipe à la victoire.</p>
                    <br>
                    <div class="developers-list" style="display: flex; justify-content: center; gap: 20px; margin: 20px 0;">
                        <div class="dev-profile">
                            <img src="assets/img/PP/lucie.png" alt="Lucie" style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid #c8aa6e; object-fit: cover;">
                            <p style="margin-top: 10px; color: #f0e6d2;">Lucie</p>
                        </div>
                        <div class="dev-profile">
                            <img src="assets/img/PP/matteo.png" alt="Matteo" style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid #c8aa6e; object-fit: cover;">
                            <p style="margin-top: 10px; color: #f0e6d2;">Matteo</p>
                        </div>
                        <div class="dev-profile">
                            <img src="assets/img/PP/raph.png" alt="Raph" style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid #c8aa6e; object-fit: cover;">
                            <p style="margin-top: 10px; color: #f0e6d2;">Raph</p>
                        </div>
                    </div>
                    <br>
                    <p>© 2026 Antre du Poro. Fait avec <3 et beaucoup de café.</p>
                </div>
            </div>
        </main>
        
        <div class="shop-details-panel"></div>
    </div>
</body>
</html>