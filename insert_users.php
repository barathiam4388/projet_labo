<?php
require_once 'config/database.php'; // Chemin selon ton projet

$pdo = Database::connect();

// -----------------------
// Infos utilisateur
$email = 'admin@cryptotrade.com';
$mot_de_passe = 'admin123';
$is_admin = 1; // 1 = admin, 0 = utilisateur normal
$solde_initial = 10000.00; // facultatif

// -----------------------
// Hash du mot de passe
$hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Insertion
$stmt = $pdo->prepare("INSERT INTO users (email, password, is_admin, solde) VALUES (?, ?, ?, ?)");
$stmt->execute([$email, $hash, $is_admin, $solde_initial]);

echo "✅ Utilisateur $email inséré avec succès.";
