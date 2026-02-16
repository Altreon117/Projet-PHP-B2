<?php
/**
 * Script de suppression d'item (delete_item.php).
 *
 * Supprime un item de la base de données sur demande de l'administrateur.
 * Redirige vers la liste des objets avec un message de confirmation.
 */
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: ../all-items_admin.php?msg=deleted");
        exit();
    }
    catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
}
else {
    header("Location: ../all-items_admin.php");
    exit();
}
?>
