<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: ./Auth/login.php");
}

require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$requestsQuery = "SELECT * FROM pending where followed =".$_SESSION['id'];
$requestsResult = mysqli_query($conn, $requestsQuery);
while($requests = mysqli_fetch_assoc($requestsResult)){
    $follower = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT * from useraccount where id='.$requests['follower']));
    echo $follower['displayName'];
    echo "<img src='data: ".$follower['profilePicDir'].";base64, ".base64_encode($follower['profilePic'])." '>";
    echo "<a href='./handleRequests.php?action=true&acc=".$follower['id']."'><button>Confirm</button></a>";
    echo "<a href='./handleRequests.php?action=false&acc=".$follower['id']."'><button>Deny</button></a>";

}

?>


