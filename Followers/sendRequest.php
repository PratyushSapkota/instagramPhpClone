<?php
session_start();
require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);
$follower = $_SESSION['id'];
$following = $_GET['id'];

$requestQuery = "insert into pending(follower, followed) values ('$follower', '$following') ";

if($conn -> query($requestQuery)){
    header('Location: ../index.php');
}