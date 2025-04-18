<?php
$code = rand(100000, 999999);
$_SESSION['pending_user'] = $user;

$pdo->prepare("UPDATE users SET two_factor_code = ? WHERE id = ?")->execute([$code, $user['id']]);

// Envoi mail
mail($user['email'], "Votre code 2FA", "Votre code est : $code");

header('Location: /views/2fa.php');
exit;

