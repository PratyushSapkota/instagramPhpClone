<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<?php
session_start();
$_SESSION['logged'] = false;
$_SESSION['id'] = null;

require '../config.php';

$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

?>

<h1>Login Page</h1>

<form action="./checkLogin.php" method="post">
    <input type="email" placeholder="email" name="email">
    <input type="password" placeholder="password" name="pass">
    <input type="submit" value="login">
</form>
<a href="./register.php">Register</a>
</body>
</html>