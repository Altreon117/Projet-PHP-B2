<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antre du Poro</title>
    <link rel="stylesheet" href="/Projet-PHP-B2/assets/css/style.css">
</head>

<body>

    <div class="lol-con-insc-window">
        <div class="background-image">
            <div class="form-container">
                <h1>Inscription</h1>
                <form action="inscription.php" method="post">
                    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <div class="button-con-insc" onclick="this.closest('form').requestSubmit()">
                        <img type="submit" src="/Projet-PHP-B2/assets/img/logos/find_match_default.png" alt="S'inscrire" >
                        <a class="texte-con-insc" >Inscription</a>
                    </div>
                    <a class="texte-to-insc" href="connexion.php">Déjà un compte ? Connectez-vous </a>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>© 2026 Antre du Poro. Tous droits réservés.</p> 
    </footer>

</body>