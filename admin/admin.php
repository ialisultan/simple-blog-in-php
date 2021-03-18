<?php

declare(strict_types=1);

session_start();

include('../inc/header.php');

require_once('../inc/functions.php');

echo '<div class="posts_wrap">';

if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && FUNC\csrf_verify($_POST['login'], $_SESSION['login'])) {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            if (FUNC\verify_user($_POST['email'], $_POST['password'])) {
                $_SESSION['admin'] = true;
                echo "Now, You can access the content <a href='admin.php'>Click here</a>";
                exit();
            } else {
                echo "Verification Error <br>";
            }
        } else {
            echo "Please make sure you entered your email and password correctly. <br>";
        }
    } else {
        echo "Something goes wrong. <br>";
    }
}

if (!isset($_SESSION['admin'])) {
    echo "You ain't authorized to access this page. Please <a href='login.php'>Login</a>";
    exit();
} elseif (isset($_SESSION['admin'])) {
    $pageNow = isset($_GET['page']) ? $_GET['page'] : '1';
    $posts_data = FUNC\get_posts($pageNow);

    echo '<table><tr><th>Title</th><th>Published At</th><th>Update</th><th>Delete</th></tr>';
    foreach ($posts_data['posts'] as $post) {
        echo '<tr><td>' . $post['title'] . '</td>';
        echo '<td>' . $post['published_at'] . '</td>';
        echo '<td>' . "<a class='button' href='edit_post.php?edit=" . $post['id'] . "'>Edit</a>" . '</td>';
        echo '<td>' . "<a class='button' href='delete_post.php?delete=" . $post['id'] . "'>Delete</a>" . '</td></tr>';
    }
    echo '</table>';

    echo '<div class="pagination_wrap">';
    echo '<div class="pagination">';
    if ($posts_data['total_pages'] >= 1) {
        for ($p = 1; $p <= $posts_data['total_pages']; $p++) {
            echo "<a class='button' href=\"?page=$p\">$p</a>";
        }
    }
    echo '</div>';
    echo '</div>';
}

echo '</div>';
include('../inc/footer.php');
