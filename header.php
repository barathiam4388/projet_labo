
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CryptoTrade</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/public/index.php">CryptoTrade</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['user'])): ?>
            <li class="nav-item"><a class="nav-link" href="/controllers/LogoutController.php">Déconnexion</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="/views/login.php">Connexion</a></li>
            <li class="nav-item"><a class="nav-link" href="/views/register.php">Inscription</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
