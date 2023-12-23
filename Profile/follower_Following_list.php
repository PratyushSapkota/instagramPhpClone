<a href="./myProfile.php"><button>Go Back</button></a>
<?php
session_start();
$type = $_GET['type'];
require "../config.php";
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

if($type == 'follower'){
    // true = followers
    $query = "SELECT * From friends where followed=".$_SESSION['id'];
    $res = 'follower';
}else{
    //following
    $query = "SELECT * From friends where follower=".$_SESSION['id'];
    $res = 'followed';
}

$listResult = mysqli_query($conn, $query);
while($list = mysqli_fetch_assoc($listResult)){
    $profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM useraccount where id=".$list[$res]));
    echo $profile['displayName'];
    echo "<br>";
}