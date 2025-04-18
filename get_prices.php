<?php
require_once '../config/database.php';
$pdo = Database::connect();
$data = $pdo->query("SELECT nom, symbole, prix FROM cryptos")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
