<?php
$dsn = 'mysql:host=localhost;dbname=career_website';
$db_user = 'career';
$db_password = 'career';

try {
    $pdo = new PDO($dsn, $db_user, $db_password);
    echo 'Database connection successful!';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
