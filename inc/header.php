<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Blog Task</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div></div>

        <div class="title">
            <a href="/index.php">
                <h1>My Blog</h1>
            </a>
        </div>

        <div class="header-buttons">

            <?php if ($_SESSION['admin']) : ?>

                <a href="/admin/admin.php" class="button">
                    Admin
                </a>
                <a href="/admin/logout.php" class="button">
                    Logout
                </a>

            <?php else : ?>

                <a href="/admin/login.php" class="button">
                    Login
                </a>

            <?php endif; ?>

        </div>

    </div>