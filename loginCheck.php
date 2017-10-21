<?php

const REQUIRED_USERNAME = 'demo';
const REQUIRED_PASSWORD = 'pass';

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == REQUIRED_USERNAME && $password == REQUIRED_PASSWORD) {
    session_start();
    $_SESSION['cso'] = md5($username);

    header('location:index.php');
} else {
    header('location:login.php?error=1');
}
