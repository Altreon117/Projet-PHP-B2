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
        <div class="background-image"></div>
        <div class="credits-box">
            <h1>GESTION UTILISATEURS</h1>
            <div class="user-table-wrap">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>MDP</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
require_once 'core/db.php';
require_once 'core/admin_auth.php';

if (isset($_POST['delete_user_id'])) {
    if ($_POST['delete_user_id'] != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$_POST['delete_user_id']]);
    }
}

$stmt = $pdo->query("SELECT * FROM users");
while ($user = $stmt->fetch()) {
    echo '<tr class="user-row">
                                <td class="user-id">' . htmlspecialchars($user['id']) . '</td>
                                <td class="user-name">' . htmlspecialchars($user['nom']) . '</td>
                                <td class="user-email">' . htmlspecialchars($user['email']) . '</td>
                                <td class="user-password">********</td>
                                <td class="user-role">' . htmlspecialchars($user['role']) . '</td>
                                <td class="user-action">
                                    <form method="POST" style="display:inline;" onsubmit="return confirm(\'Supprimer cet utilisateur ?\');">
                                        <input type="hidden" name="delete_user_id" value="' . $user['id'] . '">
                                        <button type="submit" class="user-action-btn btn-delete-confirm" aria-label="Supprimer">
                                            <img src="/Projet-PHP-B2/assets/img/logos/trash.svg" alt="Supprimer">
                                        </button>
                                    </form>
                                </td>
                            </tr>';
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer>
        <p>© 2026 Antre du Poro. Tous droits reserves.</p>
    </footer>

    <script src="/Projet-PHP-B2/assets/js/admin.js" defer></script>
</body>
</html>
