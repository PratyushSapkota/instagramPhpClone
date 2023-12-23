<head>
    <link rel="stylesheet" href="../css/newAccount.css">
</head>

<h1>Create an account</h1>
<form action="./addAcc.php" enctype="multipart/form-data" method="post">
    <label for="name">Name</label>
    <input type="text" value="Display name" name="name" id="name"> <br>
    <label for="pfp"><b>Upload a profile picture</b></label>
    <input type="file" id="pfp" name="pfp" accept="image/jpeg, image/png"> <br>
    <input id="submit" type="submit" value="Submit">
</form>