<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Home</title>
</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <section class="home-grid">
        <div class="box-container">
            <div class="box">
                <?php
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                if ($select_profile->rowCount() > 0) {
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                    $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
                    $count_user_comments->execute([$user_id]);
                    $total_user_comments = $count_user_comments->rowCount();
                    $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
                    $count_user_likes->execute([$user_id]);
                    $total_user_likes = $count_user_comments->rowCount();
                ?>
                    <p>welcome <span><?= $fetch_profile['name']; ?></span></p>
                    <p>total comments: <span><?= $total_user_comments; ?></span></p>
                    <p>posts liked: <span><?= $total_user_likes; ?></span></p>
                    <a href="update.php" class="btn">update profile</a>
                    <div class="flex-btn">
                        <a href="user_likes.php" class="option-btn">likes</a>
                        <a href="user_comments.php" class="option-btn">comments</a>
                    </div>
                <?php
                } else {
                ?>
                    <p class="name">login or register!</p>
                    <div class="flex-btn">
                        <a href="login.php" class="option-btn">login</a>
                        <a href="register.php" class="option-btn">register</a>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="box">
                <p>categories</p>
                <div class="flex-box">
                    <a href="category.php?category=nature" class="links">nature</a>
                    <a href="category.php?category=education" class="links">education</a>
                    <a href="category.php?category=business" class="links">business</a>
                    <a href="category.php?category=travel" class="links">travel</a>
                    <a href="category.php?category=news" class="links">news</a>
                    <a href="category.php?category=gaming" class="links">gaming</a>
                    <a href="category.php?category=design" class="links">design</a>
                    <a href="category.php?category=technology" class="links">technology</a>
                    <a href="category.php?category=sports" class="links">sports</a>
                    <a href="all_categories.php" class="btn">view all</a>
                </div>
            </div>
            <div class="box">
                <p>authors</p>
                <div class="flex-box">
                    <?php
                    $select_authors = $conn->prepare("SELECT DISTINCT name FROM `admin` LIMIT 10");
                    $select_authors->execute();
                    if ($select_authors->rowCount() > 0) {
                        while ($fetch_authors = $select_authors->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <a href="author_posts.php?author=<?= $fetch_authors['name'] ?>" class="links"><?= $fetch_authors['name'] ?></a>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no posts added yet</p>';
                    }
                    ?>
                    <a href="authors.php" class="btn">view all</a>
                </div>
            </div>
        </div>
    </section>
    <section class="posts-container">

    </section>

    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>