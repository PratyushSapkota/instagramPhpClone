<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
<?php
session_start();
$_SESSION['logged'] = false;
$_SESSION['id'] = null;
?>

<h1>Login Page</h1>

<form action="./checkLogin.php" method="post">
    <input id="email" type="email" placeholder="email" name="email">
    <input id="password" type="password" placeholder="password" name="pass">
    <input id="loginButton" type="submit" value="login">
</form>
<a href="./register.php" id="registerButton">Register</a>
</body>
</html>