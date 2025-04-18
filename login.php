<?php session_start(); include 'templates/header.php'; ?>
<h2>Connexion</h2>
<form action="/CryptoTrade/controllers/LoginController.php" method="post">

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Connexion</button>
</form>
<?php include 'templates/footer.php'; ?>

<?php include '../config/config.php'; ?>
<form action="<?= BASE_URL ?>/controllers/LoginController.php" method="post">
