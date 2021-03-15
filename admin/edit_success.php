<?php

session_start();

include('../inc/header.php');

require_once('../inc/functions.php');

if ($_SESSION['admin'] && isset($_POST['update'])) {
    if (!empty($_POST['edit']) && FUNC\csrf_verify($_POST['edit'], $_SESSION['edit'])) {
        $done = FUNC\update_post($_POST['title'], $_POST['content'], $_POST['id']);
        if ($done) {
            echo "<h1>Your post has been updated.</h1>";
            echo "<a href='admin.php'>Go Back</a>";
            exit();
        }
    }
} else {
    echo "Error! unauthorized access.";
    exit();
}

include('../inc/footer.php');
