<?php

declare(strict_types=1);

require_once('functions.php');

$on_page = isset($_GET['page']) ? $_GET['page'] : 1;

$posts_data = FUNC\get_posts($on_page);

?>

<div class="posts_wrap">

    <?php if (count(array($posts_data['posts'])) > 0) : ?>
        <?php foreach ($posts_data['posts'] as $post) : ?>

            <div class="post">

                <h1>
                    <?php echo $post['title']; ?>
                </h1>

                <small>
                    <?php echo $post['published_at']; ?>
                </small>

                <p>
                    <?php echo substr($post['content'], 0, 250); ?>
                </p>

                <a class="button" href="inc/post.php?post=<?php echo str_replace(' ', '-', strtolower($post['title'])); ?>">
                    Read More
                </a>

            </div>

        <?php endforeach; ?>
    <?php else : ?>

        <div class="post">
            <h1>No posts</h1>
        </div>

    <?php endif; ?>

    <div class="pagination_wrap">
        <div class="pagination">

            <?php if ($posts_data['total_pages'] >= 1) : ?>
                <?php for ($p = 1; $p <= $posts_data['total_pages']; $p++) { ?>

                    <a class="button" href="?page=<?php echo $p; ?>">
                        <?php echo "$p"; ?>
                    </a>

                <?php } ?>
            <?php endif; ?>

        </div>
    </div>

</div>