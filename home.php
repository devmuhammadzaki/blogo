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
            <div class="box"></div>
            <div class="box"></div>
            <div class="box"></div>
        </div>
    </section>
    <section class="posts-container"></section>

    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>