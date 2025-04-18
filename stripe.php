<form action="/controllers/stripe_process.php" method="POST">
  <input type="number" name="amount" placeholder="Montant en $CAD" required>
  <button type="submit" class="btn btn-success">Payer avec Stripe</button>
</form>
