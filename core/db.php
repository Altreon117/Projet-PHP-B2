<?php
/**
 * Configuration de la base de données (db.php).
 *
 * Établit la connexion PDO à la base de données MySQL.
 * Configure les modes d'erreur et le jeu de caractères.
 */
session_start();
$host = 'localhost';
$dbname = 'ecommerce_php';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>