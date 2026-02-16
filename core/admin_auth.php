<?php
/**
 * Vérification d'authentification admin (admin_auth.php).
 *
 * Bloque l'accès aux pages si l'utilisateur n'est pas connecté en tant qu'administrateur.
 * Redirige vers la page de connexion le cas échéant.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: connexion.php");
    exit;
}
?>
