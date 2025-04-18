<?php
session_start();
require_once '../config/database.php';

$code = $_POST['code'];
$user = $_SESSION['pending_user'];
$pdo = Database::connect();

$stmt = $pdo->prepare("SELECT two_factor_code FROM users WHERE id = ?");
$stmt->execute([$user['id']]);
$real_code = $stmt->fetchColumn();

if ($code == $real_code) {
    $_SESSION['user'] = $user;
    unset($_SESSION['pending_user']);
    header("Location: /views/dashboard.php");
} else {
    echo "Code incorrect.";
}
