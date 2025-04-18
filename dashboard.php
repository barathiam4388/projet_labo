<?php session_start(); include 'templates/header.php'; ?>
<h2>Tableau de bord</h2>
<p>Bienvenue, <?= htmlspecialchars($_SESSION['user']['email'] ?? 'utilisateur') ?> !</p>
<div class="alert alert-info">Fonctionnalités à venir : graphiques, transactions, portefeuille...</div>
<?php include 'templates/footer.php'; ?>
