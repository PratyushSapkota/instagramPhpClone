

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>


<div class="wrapper">
    <form action =""./checkLogin.php" method="post"">
    <h1>Register</h1>
    <div class ="input-box">
        <input id="email" type="email" placeholder="Email" name="email"><br>
        <i class='bx bxs-user'></i>
    </div>
    <div class = "input-box">
        <input id="password" type="password" placeholder="Password" name="pass"><br>
        <i class='bx bxs-lock-alt' ></i>
    </div>
    <input value= "Register" type ="submit" class ="btn">
    <div class = " registerlink">
        <p>Already have an account?<a href="./login.php" id="loginButton">Login</a></p>
    </div>
</div>
    </form>
</body>



</html>