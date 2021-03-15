<?php

require_once('functions.php');

include('header.php');


$show_post = isset($_GET["post"]) ? $_GET["post"] : "#";

if ($show_post != "#") {
    $post = FUNC\get_post($show_post);
}

?>

<div class="posts_wrap">
    <div class="post">

        <h1>
            <?php echo $post['title']; ?>
        </h1>

        <small>
            <?php echo $post['published_at']; ?>
        </small>

        <p>
            <?php echo $post['content']; ?>
        </p>

    </div>
</div>

<?php include('footer.php'); ?>