<?php

$db_name = 'mysql:host=localhost;dbname=blog_db';
$user_name = 'phpmyadmin';
$user_password = 'password';

$conn = new PDO($db_name, $user_name, $user_password);
