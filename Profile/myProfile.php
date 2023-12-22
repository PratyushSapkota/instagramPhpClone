<?php
session_start();
if(!$_SESSION['logged']){
    header("Location: ../Auth/login.php");
}

require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$userInfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM useraccount WHERE id=".$_SESSION['id']));

echo '
<input type="text" value=" '.$userInfo['displayName'].'">
"edit display name"
<br>
<img width="30px" src="data:'.$userInfo['profilePicDir'].';base64,'.base64_encode($userInfo['profilePic']).'" />
"edit photo"
<br>
<input type="text" value=" '.$userInfo['bio'].'">
"edit bio"
<br>
<a href="createPost.php"> <button>Create a post</button></a>
<a href="../index.php"> <button>Go back</button></a>
';

?>


