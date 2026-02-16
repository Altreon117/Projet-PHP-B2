<?php
/**
 * API de gestion du panier (cart_actions.php).
 *
 * Reçoit les requêtes AJAX (JSON/POST) pour ajouter, mettre à jour ou supprimer des articles du panier.
 * Retourne une réponse JSON.
 */
require_once 'db.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (!$input && isset($_POST['action'])) {
    $input = $_POST;
}

$action = $input['action'] ?? '';

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$response = ['success' => false, 'message' => 'Action invalide'];

if ($action === 'add') {
    $id = $input['id'] ?? null;
    $quantity = (int)($input['quantity'] ?? 1);

    if ($id && $quantity > 0) {
        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id] += $quantity;
        }
        else {
            $_SESSION['panier'][$id] = $quantity;
        }
        $response = ['success' => true, 'message' => 'Produit ajouté au panier', 'cart_count' => count($_SESSION['panier'])];
    }
    else {
        $response['message'] = 'ID produit ou quantité invalide';
    }
}
elseif ($action === 'remove') {
    $id = $input['id'] ?? null;
    if ($id && isset($_SESSION['panier'][$id])) {
        unset($_SESSION['panier'][$id]);
        $response = ['success' => true, 'message' => 'Produit retiré du panier'];
    }
}
elseif ($action === 'update') {
    $id = $input['id'] ?? null;
    $quantity = (int)($input['quantity'] ?? 1);

    if ($id && $quantity > 0) {
        $_SESSION['panier'][$id] = $quantity;
        $response = ['success' => true, 'message' => 'Quantité mise à jour'];
    }
    elseif ($id && $quantity <= 0) {
        unset($_SESSION['panier'][$id]);
        $response = ['success' => true, 'message' => 'Produit retiré car quantité nulle'];
    }
}
elseif ($action === 'clear') {
    $_SESSION['panier'] = [];
    $response = ['success' => true, 'message' => 'Panier vidé'];
}

echo json_encode($response);
?>
