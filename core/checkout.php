<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../connexion.php");
    exit;
}

$panier = $_SESSION['panier'] ?? [];

if (empty($panier)) {
    header("Location: ../panier.php");
    exit;
}

try {
    $pdo->beginTransaction();

    $ids = implode(',', array_map('intval', array_keys($panier)));
    $stmt = $pdo->query("SELECT * FROM items WHERE id IN ($ids)");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = 0;
    foreach ($items as $item) {
        $total += $item['prix'] * $panier[$item['id']];
    }

    $stmt = $pdo->prepare("INSERT INTO invoice (id_user, montant, adresse_facturation, ville, code_postal) VALUES (?, ?, 'Adresse par défaut', 'Ville', '00000')");
    $stmt->execute([$_SESSION['user_id'], $total]);
    $invoice_id = $pdo->lastInsertId();

    $stmt_order = $pdo->prepare("INSERT INTO orders (id_invoice, id_user, id_item, quantite) VALUES (?, ?, ?, ?)");
    $stmt_stock = $pdo->prepare("UPDATE items SET stock = stock - ?, nombre_achete = nombre_achete + ? WHERE id = ?");

    foreach ($items as $item) {
        $qty = $panier[$item['id']];
        $stmt_order->execute([$invoice_id, $_SESSION['user_id'], $item['id'], $qty]);
        $stmt_stock->execute([$qty, $qty, $item['id']]);
    }

    $pdo->commit();
    unset($_SESSION['panier']);

    header("Location: ../index.php?commande=succes");
    exit;

}
catch (Exception $e) {
    $pdo->rollBack();
    die("Erreur lors de la commande : " . $e->getMessage());
}
?>
