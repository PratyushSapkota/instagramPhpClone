<?php
session_start();
require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$availability = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM userInfo where email="'.$_POST['email'].'"'));

if($availability > 0){
    echo '<script>alert("User already with that email!")</script>';
    header('Location: ./register.php');
}
    header("Location: ./createAcc.php");

if($conn -> query('INSERT INTO userInfo( email, pass) values ( "'.$_POST['email'].'", "'.$_POST['pass'].'")')){
    $_SESSION['id'] = (mysqli_fetch_assoc(mysqli_query($conn,'SELECT id FROM userInfo where email="'.$_POST['email'].'"')))['id'];
}

