<?php

session_start();

include('../inc/header.php');

require_once('../inc/functions.php');

if($_SESSION['admin'] && !empty($_GET['delete'])){
    FUNC\delete_post($_GET['delete']);
    echo "<h1>Your post has been deleted.</h1>";
    echo "<a href='admin.php'>Go Back</a>";
    exit();
}

include('../inc/footer.php');