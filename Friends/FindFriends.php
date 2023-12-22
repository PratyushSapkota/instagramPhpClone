<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Find Friends</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <input type="text" name="displayName" placeholder="Friend's Display Name">
    <input type="submit" value="Search">
</form>
<?php
require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $displayName = $_POST['displayName'];
    $displayName = htmlspecialchars(trim($displayName));
    $searchQuery = "SELECT * FROM useraccount where displayName='" . $displayName."'";
    $searchResult = mysqli_query($conn, $searchQuery);
    while($result = mysqli_fetch_assoc($searchResult)){
        echo "<img src='data: ".$result['profilePicDir'].";base64,".base64_encode($result['profilePic'])."'> ";
        echo $result['displayName']."<br>";
        echo $result['bio'];
        echo "<a href='./sendRequest.php?id=".$result['id']."'><button>Request</button></a> <br><br>";
    }
}

?>
</body>
</html>