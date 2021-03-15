<?php

session_start();

if ($_SESSION['admin']){
    $_SESSION['admin'] = false;
    session_unset();
    echo "<h1>Logged out successfully.</h1>";
    echo "<a href='login.php'>Login</a>";
    exit();
}