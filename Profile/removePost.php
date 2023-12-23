<?php

$postId = $_GET['id'];

require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

if($conn -> query("DELETE from posts where postId=".$postId)){
    header("Location: ./myProfile.php");
}