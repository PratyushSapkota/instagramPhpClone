<head>
    <link rel="stylesheet" href="../css/requests.css">
</head>

<a href="../index.php"><button>Home</button></a>
<br>
<br>
<br>
<div id="requests">

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
    echo "<div class='each'>";
    echo "<table>";
    $follower = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT * from useraccount where id='.$requests['follower']));
    echo "<td>";
    echo "<div class='nameAndImage'><img class='image' src='data: ".$follower['profilePicDir'].";base64, ".base64_encode($follower['profilePic'])." '> </div>";
    echo "</td>";
    echo "<td>";
    echo "<div class='buttons'>";
    echo $follower['displayName'] . "<br>";
    echo "<a href='./handleRequests.php?action=true&acc=".$follower['id']."'><button class='selection'>Confirm</button></a>";
    echo "<a href='./handleRequests.php?action=false&acc=".$follower['id']."'><button class='selection'>Deny</button></a>";
    echo "</div>";
    echo "</div>";
    echo "</td>";
}

?>

</div>

