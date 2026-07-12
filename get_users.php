<?php
require 'config.php';
header('Content-Type: application/json');
$stmt = $pdo->query("SELECT id, first_name, last_name, email, account_type, status, created_at FROM users");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>  
