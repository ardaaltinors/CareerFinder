<?php
session_start();
include 'config.php'; // Include database configuration

$email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $stmt->execute(['email' => $email, 'password' => $hashed_password]);
    $_SESSION['user'] = $email;
    header('Location: index.php');
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
