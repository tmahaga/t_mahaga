<?php
require 'config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$stmt = $pdo->prepare("INSERT INTO users 
    (account_type, first_name, last_name, middle_name, gender, dob, phone, email, password_hash)
    VALUES (:type, :fname, :lname, :mname, :gender, :dob, :phone, :email, :password)");

$stmt->execute([
    ':type'     => $data['acctType'],
    ':fname'    => $data['fname'],
    ':lname'    => $data['lname'],
    ':mname'    => $data['mname'] ?? null,
    ':gender'   => $data['gender'],
    ':dob'      => $data['dob'],
    ':phone'    => $data['phone'],
    ':email'    => $data['email'],
    ':password' => password_hash($data['pw1'], PASSWORD_DEFAULT),
]);

$userId = $pdo->lastInsertId();

// insert into student_profiles or staff_profiles depending on type
// insert into digital_ids with a generated VID number
// insert into security_questions with hashed answer

echo json_encode(["success" => true, "user_id" => $userId]);
