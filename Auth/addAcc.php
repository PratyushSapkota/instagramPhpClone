<?php
require '../config.php';
session_start();
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$image = null;
$imageDir = null;

if( $_FILES['pfp']['error'] == UPLOAD_ERR_OK ){

$image = $_FILES['pfp']['tmp_name'];
$imageDir = $_FILES['pfp']['type'];

$imageData = file_get_contents($image);
$imageData = mysqli_real_escape_string($conn, $imageData);

}
$name = $_POST['name'];
$id = $_SESSION['id'];

$query = "INSERT INTO useraccount(id, displayName, profilePic, profilePicDir) values (".$id.", '".$name."', '".$imageData."', '".$imageDir."')";

if($conn -> query($query)){
    $_SESSION['logged'] = true;
    header('Location: ../index.php');
}