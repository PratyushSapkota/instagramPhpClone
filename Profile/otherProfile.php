<head>
    <link rel="stylesheet" href="../css/otherProfile.css">
</head>

<?php
$uploaderId = $_GET['id'];

require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$user = mysqli_fetch_assoc(mysqli_query($conn, "select * from useraccount where id=".$uploaderId));
?>

<a href="../index.php"><button>Back to home</button></a> <br>

<div id="userDetails">
        <img id="profilePic" src="<?php echo 'data: '.$user['profilePicDir'].';base64, '.base64_encode($user['profilePic']).' ' ?>" alt="">
         <?php echo $user['displayName'] ?>
        <div id="bio">
            <?php echo $user['bio']?>
        </div>
</div>

<h4>Public posts of user: </h4>

<?php

$publicPostsQuery = "SELECT * from posts where uploader=".$uploaderId." and post_type=0";
$publicPostsResult = mysqli_query($conn, $publicPostsQuery);



while($publicPosts = mysqli_fetch_assoc($publicPostsResult)){
    echo "<div class='eachPost'>";
    echo "<div class='PostCaption'>" . $publicPosts['caption'] . "</div> <div class='description'><i> " . $publicPosts['description'] ." </i></div>";
    echo '<div class="PostLocation"> <svg class="locationSvg" style="color: blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18,4.48a8.45,8.45,0,0,0-12,12l5.27,5.28a1,1,0,0,0,1.42,0L18,16.43A8.45,8.45,0,0,0,18,4.48ZM16.57,15,12,19.59,7.43,15a6.46,6.46,0,1,1,9.14,0ZM9,7.41a4.32,4.32,0,0,0,0,6.1,4.31,4.31,0,0,0,7.36-3,4.24,4.24,0,0,0-1.26-3.05A4.3,4.3,0,0,0,9,7.41Zm4.69,4.68a2.33,2.33,0,1,1,.67-1.63A2.33,2.33,0,0,1,13.64,12.09Z" fill="blue"></path></svg> ' . $publicPosts['location'] . '</div>';
    echo '<img class="PostImage" src="data:' . $publicPosts['imageDir'] . ';base64,' . base64_encode($publicPosts['image']) . '" >';
    echo "</div>";
    echo '<br>';
    echo '<br>';
}
?>



