<?php
/**
 * Script d'initialisation des consommables et bottes (setup_consumables.php).
 *
 * Peuple la base de données avec une liste prédéfinie d'objets (consommables, bottes).
 * Vérifie l'existence avant insertion pour éviter les doublons.
 */
require_once 'core/db.php';

$consumables = [
    ['Refillable Potion', 150, 'assets/img/consumables/40px-Refillable_Potion_item.png', 'Restores health over time. Refills at shop.', 'consumable', 100],
    ['Health Potion', 50, 'assets/img/consumables/Health_Potion_item.png', 'Restores health over time.', 'consumable', 100],
    ['Farsight Alteration', 0, 'assets/img/consumables/Farsight_Alteration_item.png', 'Increases vision range.', 'consumable', 100],
    ['Oracle Lens', 0, 'assets/img/consumables/Oracle_Lens_item.png', 'Scans for hidden units.', 'consumable', 100],
    ['Stealth Ward', 0, 'assets/img/consumables/Stealth_Ward_item.png', 'Provides vision.', 'consumable', 100],
    ['Elixir of Iron', 500, 'assets/img/consumables/Elixir_of_Iron_item.png', 'Increases size and tenacity.', 'consumable', 100],
    ['Elixir of Wrath', 500, 'assets/img/consumables/Elixir_of_Wrath_item.png', 'Grants physical vamp.', 'consumable', 100],
    ['Elixir of Sorcery', 500, 'assets/img/consumables/Elixir_of_Sorcery_item.png', 'Grants AP and mana regen.', 'consumable', 100],
    ['Control Ward', 75, 'assets/img/consumables/Control_Ward_item.png', 'Disables nearby wards.', 'consumable', 100]
];

$boots = [
    ['Boots of Swiftness', 1000, 'assets/img/boots/Boots_of_Swiftness_item.png', 'Increases movement speed.', 'boots', 100],
    ['Berserker\'s Greaves', 1100, 'assets/img/boots/Berserker_s_Greaves_item.png', 'Increases attack speed.', 'boots', 100],
    ['Boots', 300, 'assets/img/boots/Boots_item.png', 'Slightly increases movement speed.', 'boots', 100],
    ['Mercury\'s Treads', 1250, 'assets/img/boots/Mercury_s_Treads_item.png', 'Reduces crowd control duration.', 'boots', 100],
    ['Chainlaced Crushers', 1250, 'assets/img/boots/Chainlaced_Crushers_item.png', 'Grants armor and movement speed.', 'boots', 100],
    ['Sorcerer\'s Shoes', 1100, 'assets/img/boots/Sorcerer_s_Shoes_item.png', 'Increases magic penetration.', 'boots', 100],
    ['Plated Steelcaps', 1200, 'assets/img/boots/Plated_Steelcaps_item.png', 'Blocks basic attack damage.', 'boots', 100],
    ['Armored Advance', 1200, 'assets/img/boots/Armored_Advance_item.png', 'Grants armor and tenacity.', 'boots', 100],
    ['Ionian Boots of Lucidity', 900, 'assets/img/boots/Ionian_Boots_of_Lucidity_item.png', 'Reduces cooldowns.', 'boots', 100]
];

$items = array_merge($consumables, $boots);

foreach ($items as $item) {
    $stmt = $pdo->prepare("SELECT id FROM items WHERE nom = ?");
    $stmt->execute([$item[0]]);
    if (!$stmt->fetch()) {
        $insert = $pdo->prepare("INSERT INTO items (nom, prix, image, description, categorie, stock) VALUES (?, ?, ?, ?, ?, ?)");
        $insert->execute($item);
        echo "Inserted: " . $item[0] . "<br>";
    }
    else {
        echo "Exists: " . $item[0] . "<br>";
    }
}
echo "Done.";
?>
