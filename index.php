<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>You have entered the matrix.</p>
    <?php if (logged_in()) : ?>
        <p>Welcome, <?= $_SESSION['user']['username']; ?>!</p>
    <?php endif; ?>
</article>


<div class="post-container">
    <ol>
        <?php $posts = getPosts($pdo, 0); ?>
        <?php foreach ($posts as $post) : ?>
            <?php if (logged_in()) : ?>
                <?php if (checkIfUpvoted($pdo, $post['post_id'])) : ?>
                    <form action="/app/posts/upvotes.php" method="post">
                        <input type="hidden" name="post_id" id="post_id" value="<?= $post['post_id'] ?>">
                        <button type="submit" name="submit" id="submit" value="remove">Upvoted</button>
                    </form>
                <?php else : ?>
                    <form action="/app/posts/upvotes.php" method="post">
                        <input type="hidden" name="post_id" id="post_id" value="<?= $post['post_id'] ?>">
                        <button type="submit" name="submit" id="submit" value="add"></button>
                    </form>
                <?php endif ?>
            <?php endif ?>
            <p><?= $post['votes'] ?></p>
            <a href="/post.php?post_id=<?= $post['post_id'] ?>"><?= $post['title'] ?></a>
            <a href="<?= $post['link'] ?>"><?= $post['link'] ?></a>
            <p>Created on <?= $post['created_at'] ?></p>
            <p>Created by <?= getUserByID($pdo, $post['user_id'])['username'] ?></p>
        <?php endforeach ?>
    </ol>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>