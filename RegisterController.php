<?php
require_once '../config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $token = $_POST['token'];

    if (!$email || !$password || !$token) {
        $_SESSION['error'] = "Champs invalides.";
        header('Location: /views/register.php');
        exit;
    }

    $pdo = Database::connect();

    // Vérifie si le jeton existe (admin doit les avoir créés dans une table "invitation_tokens")
    $stmt = $pdo->prepare("SELECT * FROM invitation_tokens WHERE token = ? AND used = 0");
    $stmt->execute([$token]);

    if ($stmt->rowCount() === 0) {
        $_SESSION['error'] = "Jeton invalide.";
        header('Location: /views/register.php');
        exit;
    }

    // Hash du mot de passe
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (email, password, token) VALUES (?, ?, ?)");
    $stmt->execute([$email, $hash, $token]);

    // Marquer le jeton comme utilisé
    $pdo->prepare("UPDATE invitation_tokens SET used = 1 WHERE token = ?")->execute([$token]);

    $_SESSION['success'] = "Inscription réussie. Connectez-vous.";
    header('Location: /views/login.php');
}
