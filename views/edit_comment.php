<?php require dirname(__DIR__, 1) . '/app/autoload.php'; ?>
<?php require __DIR__ . '/header.php'; ?>

<?php
if (!logged_in()) {
    redirect('/views/login.php');
    exit;
}
?>

<?php if (isset($_POST['submit'])) : ?>
    <form action="../app/comments/update.php" method="post" class="edit-comment">
        <div class="form-element">
            <textarea name="comment" id="comment" cols="30" rows="10"><?= $_POST['edit'] ?></textarea>
            <input type="hidden" name="post_id" value="<?= $_POST['post_id'] ?>">
            <br>
            <button type="submit" name="submit" value="<?= $_POST['submit'] ?>" class="button3">Submit changes</button>
        </div>
    </form>
<?php endif ?>

<?php require __DIR__ . '/footer.php'; ?>