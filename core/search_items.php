<?php
require_once 'db.php';

header('Content-Type: application/json');

$query = $_GET['q'] ?? '';

if (strlen($query) < 2) {
    echo json_encode([]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, nom, prix, image, description FROM items WHERE nom LIKE :q OR description LIKE :q2 LIMIT 10");
    $stmt->execute([
        ':q' => '%' . $query . '%',
        ':q2' => '%' . $query . '%'
    ]);

    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as &$item) {
        $item['nom'] = htmlspecialchars($item['nom']);
        $item['description'] = htmlspecialchars($item['description']);
        $item['image'] = htmlspecialchars($item['image']);
        $item['prix'] = (int)$item['prix'];
    }

    echo json_encode($items);
}
catch (PDOException $e) {
    echo json_encode(['error' => 'Database error']);
}
