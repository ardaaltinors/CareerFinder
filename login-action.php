<?php
session_start();
include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['email'];
        header('Location: index.php');
    } else {
        header('Location: login.php?error=Invalid credentials');
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
