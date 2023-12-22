<?php
session_start();

require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$id = $_SESSION['id'];
$caption = $_POST['caption'];
$description = $_POST['description'];
$type = $_POST['type'];
$location = $_POST['location'];
$image = $_FILES['image']['tmp_name'];
$imageDir = $_FILES['image']['type'];
$imageData = file_get_contents($image);
$imageData = mysqli_real_escape_string($conn, $imageData);


$query = "INSERT INTO posts(uploader, caption, description, post_type, location, image, imageDir) values ('$id', '$caption', '$description', '$type', '$location', '$imageData', '$imageDir')";

if($conn -> query($query)){
    header('Location: ../index.php');
}