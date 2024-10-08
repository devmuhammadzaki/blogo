<?php

if (isset($message)) {
    foreach ($message as $message) {
        echo '
            <div class="message">
                <span>' . $message . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        ';
    }
}

?>

<header class="header">
    <section class="flex">
        <a href="index.php" class="logo">Blogo.</a>

        <form action="search.php" method="POST" class="search-form">
            <input type="text" name="search_box" class="box" maxlength="100" placeholder="search for blogs" required>
            <button type="submit" class="fas fa-search" name="search-btn"></button>
        </form>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="lightmode-btn" class="fas fa-lightbulb" onclick="toggleMode()"></div>
            <div id="darkmode-btn" class="fas fa-moon hidden" onclick="toggleMode()"></div>
        </div>

        <nav class="navbar">
            <a href="index.php"><i class="fas fa-angle-right"></i> home</a>
            <a href="posts.php"><i class="fas fa-angle-right"></i> posts</a>
            <a href="all_categories.php"><i class="fas fa-angle-right"></i> categories</a>
            <a href="authors.php"><i class="fas fa-angle-right"></i> authors</a>
            <a href="login.php"><i class="fas fa-angle-right"></i> login</a>
            <a href="register.php"><i class="fas fa-angle-right"></i> register</a>
        </nav>

        <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);

            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
                <p class="name"><?= $fetch_profile['name'] ?></p>
                <a href="update.php" class="btn">update profile</a>
                <a href="components/user_logout.php" class="delete-btn">logout</a>
            <?php
            } else {
            ?>
                <p class="name">please login first!</p>
                <a href="login.php" class="option-btn">login</a>
            <?php
            }
            ?>
        </div>
    </section>
</header>