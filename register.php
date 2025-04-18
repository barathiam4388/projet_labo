<?php session_start(); include 'header.php'; ?>
<h2>Inscription</h2>
<form action="/controllers/RegisterController.php" method="post">
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jeton d’invitation</label>
        <input type="text" name="token" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Créer un compte</button>
</form>
<?php include 'templates/footer.php'; ?>
