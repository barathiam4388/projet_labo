<?php
require_once '../config/database.php';
session_start();

if (!isset($_SESSION['user'])) exit("Non autorisé");

$pdo = Database::connect();

$user_id = $_SESSION['user']['id'];
$crypto_id = $_POST['crypto_id'];
$type = $_POST['type']; // achat ou vente
$quantite = floatval($_POST['quantite']);

// Prix actuel
$stmt = $pdo->prepare("SELECT prix FROM cryptos WHERE id = ?");
$stmt->execute([$crypto_id]);
$prix = $stmt->fetchColumn();

$total = $quantite * $prix;

// Vérifier solde ou quantité détenue
if ($type === 'achat') {
    // Vérif solde
    $stmt = $pdo->prepare("SELECT solde FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $solde = $stmt->fetchColumn();
    if ($solde < $total) die("Solde insuffisant");

    // Mise à jour
    $pdo->prepare("UPDATE users SET solde = solde - ? WHERE id = ?")->execute([$total, $user_id]);
} else {
    // Vérif vente possible → bonus : ajouter une table portefeuille (optionnel ici)
}

// Enregistrer la transaction
$pdo->prepare("INSERT INTO transactions (user_id, crypto_id, type, quantite, prix_unitaire)
               VALUES (?, ?, ?, ?, ?)")
    ->execute([$user_id, $crypto_id, $type, $quantite, $prix]);

echo "Transaction réussie.";
