

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register</title>
</head>
<body>

<div id="container">
    <div id="heading">
        <h1>Register Page</h1>
    </div>
    <form action="./newRegister.php" method="post">
        <input id="email" type="email" placeholder="email" name="email"><br>
        <input id="password" type="password" placeholder="password" name="pass"><br>
        <input id="registerButton" type="submit" value="register">
    </form>
    <p> Or</p>
    <a href="./login.php" id="loginButton">login</a>
</div>
</body>
</html>