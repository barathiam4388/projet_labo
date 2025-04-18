<?php
require_once '../config/database.php';

$pdo = Database::connect();

// Récupérer toutes les cryptos
$cryptos = $pdo->query("SELECT * FROM cryptos")->fetchAll();

foreach ($cryptos as $crypto) {
    $volatilite = $crypto['volatilite'];
    $variation = 0;

    switch ($volatilite) {
        case 'faible':
            $variation = rand(-5, 5) / 1000; // ±0.5%
            break;
        case 'moyenne':
            $variation = rand(-20, 20) / 1000; // ±2%
            break;
        case 'forte':
            $variation = rand(-50, 50) / 1000; // ±5%
            break;
    }

    $nouveau_prix = $crypto['prix'] * (1 + $variation);
    $nouveau_prix = round($nouveau_prix, 2);

    // Mise à jour en DB
    $stmt = $pdo->prepare("UPDATE cryptos SET prix = ? WHERE id = ?");
    $stmt->execute([$nouveau_prix, $crypto['id']]);

    // Historique
    $stmt = $pdo->prepare("INSERT INTO prix_historique (crypto_id, prix) VALUES (?, ?)");
    $stmt->execute([$crypto['id'], $nouveau_prix]);
}
