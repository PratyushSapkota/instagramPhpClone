<?php 
 session_start();
$email = $_POST['email'];
$password = $_POST['pass'];

include '../config.php';

$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

 $loginCheck = 'SELECT id FROM userInfo where email="'.$email.'" and pass="'.$password.'"';
 $result = mysqli_query($conn, $loginCheck);
 $info = mysqli_fetch_assoc($result);
 if(mysqli_num_rows($result) > 0){
     $_SESSION['logged'] = true;
     $_SESSION['id'] = $info['id'];
     header("Location: ../index.php");
//     echo 'SUCCESS';
 }else{
     header("Location: ./login.php");
//     echo 'no way';
 }


?>