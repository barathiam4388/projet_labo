<?php session_start(); include 'templates/header.php'; ?>
<h2>Authentification 2FA</h2>
<form method="POST" action="/controllers/Verify2FAController.php">
  <label>Code reçu par email</label>
  <input type="text" name="code" required class="form-control">
  <button class="btn btn-primary mt-2">Valider</button>
</form>
<?php include 'templates/footer.php'; ?>
