<?php

declare(strict_types=1);

session_start();

include('../inc/header.php');

require_once('../inc/functions.php');

if (isset($_SESSION['admin'])) {
    echo "You are authorized to access the <a href='admin.php'>Admin Panel</a>";
    exit();
}

?>

<div class="form_wrap">
    <form action="admin.php" method="post">
        <input type="email" name="email" placeholder="Enter your email"> <br>
        <input type="password" name="password" placeholder="Enter your password"> <br>
        <input type="submit" name="submit" value="Login">
        <input type="hidden" name="login" value="<?php echo FUNC\login_request(); ?>">
    </form>
</div>

<?php include('../inc/footer.php'); ?>