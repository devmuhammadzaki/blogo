<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:index.php');
}

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="assets/icon.png" type="image/x-icon">
    <title>User Likes</title>
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <section class="posts-container">
        <h1 class="heading">Liked Posts</h1>

        <div class="box-container">

            <?php
            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
            $select_likes->execute([$user_id]);
            if ($select_likes->rowCount() > 0) {
                while ($fetch_likes = $select_likes->fetch(PDO::FETCH_ASSOC)) {
                    $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
                    $select_posts->execute([$fetch_likes['post_id']]);
                    if ($select_posts->rowCount() > 0) {
                        while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
                            if ($fetch_posts['status'] != 'deactive') {

                                $post_id = $fetch_posts['id'];

                                $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
                                $count_post_likes->execute([$post_id]);
                                $total_post_likes = $count_post_likes->rowCount();

                                $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
                                $count_post_likes->execute([$post_id]);
                                $total_post_likes = $count_post_likes->rowCount();
            ?>
                                <form class="box" method="post">
                                    <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                                    <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
                                    <div class="post-admin">
                                        <i class="fas fa-user"></i>
                                        <div>
                                            <a href="author_posts.php?author=<?= $fetch_posts['name']; ?>"><?= $fetch_posts['name']; ?></a>
                                            <div><?= $fetch_posts['date']; ?></div>
                                        </div>
                                    </div>

                                    <?php
                                    if ($fetch_posts['image'] != '') {
                                    ?>
                                        <img src="uploaded_imgs/<?= $fetch_posts['image']; ?>" class="post-image" alt="">
                                    <?php
                                    }
                                    ?>
                                    <div class="post-title"><?= $fetch_posts['title']; ?></div>
                                    <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
                                    <a href="view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">read more</a>
                                    <div class="icons">
                                        <a href="view_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment"></i><span>(<?= $total_post_likes; ?>)</span></a>
                                        <button type="submit" name="like_post" style="background-color: var(--light-bg);"><i class="fas fa-heart" style="<?php if ($total_post_likes > 0 and $user_id != '') {
                                                                                                                                                                echo 'color:red;';
                                                                                                                                                            }; ?>"></i><span>(<?= $total_post_likes; ?>)</span></button>
                                    </div>

                                </form>
            <?php
                            }
                        }
                    } else {
                        echo '<p class="empty">no posts found for this category!</p>';
                    }
                }
            } else {
                echo '<p class="empty">no liked posts available!</p>';
            }
            ?>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>