<?php
require_once 'core/db.php';
$stmt = $pdo->query("SELECT nom, categorie FROM items");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($items as $item) {
    if (stripos($item['nom'], 'ward') !== false || stripos($item['nom'], 'lens') !== false || stripos($item['nom'], 'alteration') !== false || stripos($item['nom'], 'balise') !== false || stripos($item['nom'], 'brouilleur') !== false || stripos($item['nom'], 'scrybe') !== false) {
        echo $item['nom'] . " (" . $item['categorie'] . ")<br>";
    }
}
?>
