<?php
require_once '../config/database.php';
session_start();
include 'templates/header.php';

if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-danger'>Vous devez être connecté pour voir votre portefeuille.</div>";
    include 'templates/footer.php';
    exit;
}

$user_id = $_SESSION['user']['id'];
$pdo = Database::connect();

// Récupérer toutes les cryptos achetées/vendues par l'utilisateur
$stmt = $pdo->prepare("
SELECT c.nom, c.symbole, 
       SUM(CASE WHEN t.type = 'achat' THEN t.quantite ELSE -t.quantite END) AS quantite_totale,
       c.prix
FROM transactions t
JOIN cryptos c ON t.crypto_id = c.id
WHERE t.user_id = ?
GROUP BY t.crypto_id
");
$stmt->execute([$user_id]);
$portefeuille = $stmt->fetchAll();
?>

<h2>Mon portefeuille</h2>

<?php if (count($portefeuille) == 0): ?>
    <div class="alert alert-info">Vous n'avez encore aucune crypto-monnaie dans votre portefeuille.</div>
<?php else: ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Crypto</th>
                <th>Quantité</th>
                <th>Prix actuel</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        foreach ($portefeuille as $item):
            if ($item['quantite_totale'] <= 0) continue; // Ignore si vendu totalement
            $valeur = $item['prix'] * $item['quantite_totale'];
            $total += $valeur;
        ?>
            <tr>
                <td><?= htmlspecialchars($item['nom']) ?> (<?= htmlspecialchars($item['symbole']) ?>)</td>
                <td><?= number_format($item['quantite_totale'], 4) ?></td>
                <td><?= number_format($item['prix'], 2) ?> $</td>
                <td><?= number_format($valeur, 2) ?> $</td>
            </tr>
        <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total du portefeuille</strong></td>
                <td><strong><?= number_format($total, 2) ?> $</strong></td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>

<?php include 'templates/footer.php'; ?>
