<?php
require_once '../config/database.php';
session_start();
include 'templates/header.php';

$crypto_id = $_GET['id'] ?? 1;

$pdo = Database::connect();
$stmt = $pdo->prepare("SELECT * FROM prix_historique WHERE crypto_id = ? ORDER BY date ASC");
$stmt->execute([$crypto_id]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$dates = [];
$prices = [];
foreach ($data as $row) {
    $dates[] = $row['date'];
    $prices[] = $row['prix'];
}
?>

<h2>Graphique de la crypto</h2>
<canvas id="chartCrypto"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartCrypto');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($dates) ?>,
        datasets: [{
            label: 'Prix ($)',
            data: <?= json_encode($prices) ?>,
            fill: false,
            borderColor: 'blue',
            tension: 0.1
        }]
    }
});
</script>

<?php include 'templates/footer.php'; ?>
