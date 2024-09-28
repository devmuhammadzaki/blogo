<?php

$db_name = 'mysql:host=localhost;dbname=blog_db';
$user_name = 'phpmyadmin';
$user_password = 'password';

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
