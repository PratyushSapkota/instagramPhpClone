<?php
session_start();

$id = $_SESSION['id'];
$reciever =  $_GET['id'];
require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);


$isFriends = "Select * from friends where (p1=".$reciever." and p2=".$id.") or (p2=".$reciever." and p1=".$id.") ";
$isFriendsResult = mysqli_query($conn, $isFriends);
if(mysqli_num_rows($isFriendsResult) > 0){

}