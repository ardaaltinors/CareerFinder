<?php
$db_file = __DIR__ . '/data/career_website.db';
try {
    $pdo = new PDO('sqlite:' . $db_file);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS jobs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT NOT NULL,
        salary TEXT NOT NULL,
        location TEXT NOT NULL,
        type TEXT NOT NULL,
        tags TEXT NOT NULL,
        requirements TEXT NOT NULL,
        benefits TEXT NOT NULL,
        company TEXT NOT NULL,
        address TEXT NOT NULL,
        city TEXT NOT NULL,
        state TEXT NOT NULL,
        phone TEXT NOT NULL,
        email TEXT NOT NULL,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )");
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
