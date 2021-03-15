<?php

session_start();

include('../inc/header.php');

require_once('../inc/functions.php');

if (!empty($_GET['edit'] && $_SESSION['admin'])) {
    $post = FUNC\edit_post($_GET['edit']);
    // FUNC\dd($post);
} else {
    echo "Error! unauthorized access.";
    exit();
}

?>

<div class="form_wrap">
    <form action="edit_success.php" method="post">
        <label>Title<input type="text" name="title" value="<?php echo $post['title']; ?>"></label>
        <label>Content<textarea name="content" rows="30"><?php echo $post['content']; ?></textarea></label>
        <input type="submit" name="update" value="Update">
        <input type="hidden" name="edit" value="<?php echo FUNC\edit_request(); ?>">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    </form>
</div>

<?php include('../inc/footer.php'); ?>