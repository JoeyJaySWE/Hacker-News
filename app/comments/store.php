<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/login.php');
    exit;
}

if (isset($_POST['comment'])) {
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
    if (strlen($comment) >= 1000) {
        redirect('/views/post.php?post_id=' . $post_id);
        $_SESSION['errors']['commentTooLong'] = "Character limit reached";
        exit;
    }
    $statement = $pdo->prepare('INSERT INTO comments (content, created_at, post_id, user_id) VALUES (:content, :created_at, :post_id, :user_id)');

    $statement->bindParam(':content', $comment, PDO::PARAM_STR);
    $statement->bindParam(':created_at', date("d-m-Y/H:i:s"), PDO::PARAM_STR);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $statement->execute();
}

redirect('/views/post.php?post_id=' . $post_id);
