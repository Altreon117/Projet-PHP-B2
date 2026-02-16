<?php
/**
 * Page de connexion (connexion.php).
 *
 * Gère l'authentification des utilisateurs et des administrateurs.
 * Vérifie les identifiants et initialise la session.
 */
require_once 'core/db.php';

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    }
    else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE nom = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nom'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: index_admin.php");
            }
            else {
                header("Location: index.php");
            }
            exit;
        }
        else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
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

    <div class="lol-con-insc-window">
        <div class="background-image">
            <div class="form-container">
                <h1>Connexion</h1>
                <?php if ($error): ?>
                    <p style="color: red;background: rgba(0,0,0,0.7);padding: 10px;border-radius: 5px;"><?php echo htmlspecialchars($error); ?></p>
                <?php
endif; ?>
                <form action="connexion.php" method="post">
                    <input type="text" name="username" placeholder="Nom d'utilisateur" required value="<?php echo htmlspecialchars($username); ?>">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <div class="button-con-insc" onclick="this.closest('form').requestSubmit()">
                        <img type="submit" src="/Projet-PHP-B2/assets/img/logos/find_match_default.png" alt="Se connecter" >
                        <a class="texte-con-insc" >Connexion</a>
                    </div>
                    <a class="texte-to-insc" href="inscription.php">Pas encore de compte ? Inscrivez-vous </a>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>© 2026 Antre du Poro. Tous droits réservés.</p> 
    </footer>

    <script src="/Projet-PHP-B2/assets/js/validation.js" defer></script>
</body>
</html>