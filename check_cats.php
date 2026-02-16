<?php
/**
 * Script utilitaire de vérification (check_cats.php).
 *
 * Affiche les catégories distinctes présentes en base de données pour débogage.
 */
require_once 'core/db.php';
$stmt = $pdo->query("SELECT DISTINCT categorie FROM items");
print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
?>
