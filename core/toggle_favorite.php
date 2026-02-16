<?php
require_once 'db.php';


header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$itemId = $data['itemId'] ?? null;

if (!$itemId) {
    echo json_encode(['success' => false, 'message' => 'ID invalide']);
    exit;
}

$userId = $_SESSION['user_id'];

try {
    $stmtCheck = $pdo->prepare("SELECT id FROM user_favorites WHERE id_user = ? AND id_item = ?");
    $stmtCheck->execute([$userId, $itemId]);
    $existing = $stmtCheck->fetch();

    if ($existing) {
        $stmtDel = $pdo->prepare("DELETE FROM user_favorites WHERE id_user = ? AND id_item = ?");
        $stmtDel->execute([$userId, $itemId]);
        $isFav = false;
    }
    else {
        $stmtAdd = $pdo->prepare("INSERT INTO user_favorites (id_user, id_item) VALUES (?, ?)");
        $stmtAdd->execute([$userId, $itemId]);
        $isFav = true;
    }

    echo json_encode([
        'success' => true,
        'isFavorite' => $isFav,
        'debug' => [
            'user_id' => $userId,
            'item_id' => $itemId,
            'action' => $isFav ? 'added' : 'removed'
        ]
    ]);
}
catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur BDD: ' . $e->getMessage()]);
}
?>
