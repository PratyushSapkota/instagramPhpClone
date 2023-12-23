<?php
session_start();
require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$action = $_GET['action'];
$follower = $_GET['acc'];
$followed = $_SESSION['id'];

if ($action) {
    $query = "INSERT INTO friends(follower, followed) values ('$follower', '$followed')";
    $query2 = "DELETE from pending where follower = '$follower' and followed ='$followed' ";
} else {
    $query = "DELETE from pending where follower = '$follower' and followed ='$followed' ";
    $query2 = null;
}

$res1 = $conn->query($query);

if (isset($query2)) {
    $res2 = $conn->query($query2);
} else {
    $res2 = true;
}

if ($res1 and $res2) {
    header('Location: ./requests.php');
}

