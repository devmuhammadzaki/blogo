<?php

$db_name = 'mysql:host=localhost;db_name=blog_db';
$username = 'phpmyadmin';
$user_password = 'password';

$con = new PDO($db_name, $username, $user_password);
