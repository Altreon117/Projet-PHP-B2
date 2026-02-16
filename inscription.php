<?php
/**
 * Page d'inscription (inscription.php).
 *
 * Permet aux nouveaux utilisateurs de créer un compte.
 * Enregistre les informations dans la base de données après validation.
 */
require_once 'core/db.php';

$error = '';
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        $error = "Tous les champs sont obligatoires.";
    }
    elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    }
    else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = "Cet email est déjà utilisé.";
        }
        else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, 'client')");

            if ($stmt->execute([$username, $email, $hashed_password])) {
                header("Location: connexion.php");
                exit;
            }
            else {
                $error = "Une erreur est survenue lors de l'inscription.";
            }
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
                <h1>Inscription</h1>
                <?php if ($error): ?>
                    <p style="color: red;background: rgba(0,0,0,0.7);padding: 10px;border-radius: 5px;"><?php echo htmlspecialchars($error); ?></p>
                <?php
endif; ?>
                <form action="inscription.php" method="post">
                    <input type="text" name="username" placeholder="Nom d'utilisateur" required value="<?php echo htmlspecialchars($username); ?>">
                    <input type="email" name="email" placeholder="Adresse email" required value="<?php echo htmlspecialchars($email); ?>">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <input type="password" name="password_confirm" placeholder="Confirmez le mot de passe" required>
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

    <script src="/Projet-PHP-B2/assets/js/validation.js" defer></script>
</body>
</html>