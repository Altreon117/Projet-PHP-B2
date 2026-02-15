<?php
require_once 'core/db.php';
$stmt = $pdo->query("SELECT DISTINCT categorie FROM items");
print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
?>
