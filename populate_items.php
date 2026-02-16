<?php
/**
 * Script de population d'items de test (populate_items.php).
 *
 * Vide la table items et génère des objets aléatoires pour le développement et les tests.
 * Assigne des stats et rôles cohérents de manière procédurale.
 */
require_once 'core/db.php';

try {
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("TRUNCATE TABLE items");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    $roles = ['fighter', 'marksman', 'assassin', 'mage', 'tank', 'support'];

    $stats_map = [
        'fighter' => 'ad health armor',
        'marksman' => 'ad crit attackspeed',
        'assassin' => 'ad movespeed arpenpen',
        'mage' => 'ap mana magpen cdr',
        'tank' => 'health armor magres tenacity',
        'support' => 'health cdr mana'
    ];

    $stmt = $pdo->prepare("INSERT INTO items (nom, description, prix, stock, image, categorie) VALUES (?, ?, ?, ?, ?, ?)");

    for ($i = 1; $i <= 50; $i++) {
        $role = $roles[array_rand($roles)];
        $stats = $stats_map[$role];

        $nom = "Objet " . ucfirst($role) . " " . $i;
        $description = "Stats: " . $stats . " - Description de l'objet " . $i;
        $prix = rand(300, 3600);
        $stock = rand(10, 100);
        $image = "assets/img/logos/recall.png";
        $categorie = $role;

        $stmt->execute([$nom, $description, $prix, $stock, $image, $categorie]);
    }

    echo "50 articles insérés avec succès.";

}
catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
