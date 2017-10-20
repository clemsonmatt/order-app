<?php

session_start();

if (! isset($_SESSION['cso'])) {
    // user not logged in so redirect
    header('location:login.php');
}

require_once('oracle.inc.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order App</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background: #f4f5f6;">
    <h1>Header</h1>
