<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
    <title>CareerFinder</title>
</head>

<body class="bg-gray-100">
    <!-- Nav -->
    <header class="bg-blue-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-semibold">
                <a href="index.php">CareerFinder</a>
            </h1>
            <nav class="space-x-4">
                <?php if (isset($_SESSION['user'])) : ?>
                    <a href="logout.php" class="text-white hover:underline">Logout</a>
                <?php else : ?>
                    <a href="login.php" class="text-white hover:underline">Login</a>
                    <a href="register.php" class="text-white hover:underline">Register</a>
                <?php endif; ?>
                <a href="post-job.php" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
                    <i class="fa fa-edit"></i> Post a Job
                </a>
            </nav>
        </div>
    </header>