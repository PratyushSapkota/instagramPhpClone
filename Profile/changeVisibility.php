<?php
$postId = $_GET['id'];
$currentType = $_GET['curr'];

require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

if($currentType == 1){
    $query = "update posts SET post_type = 0 where postId = ".$postId;
}else{
    $query = "update posts SET post_type = 1 where postId = ".$postId;
}

if($conn -> $query){
    header("Location: ./myProfile.php");
}