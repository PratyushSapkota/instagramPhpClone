<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: ./Auth/login.php");
}

require './config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$userInfo = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT * FROM useraccount where id=' . $_SESSION['id']));

echo '<img width="30px" src="data:' . $userInfo['profilePicDir'] . ';base64,' . base64_encode($userInfo['profilePic']) . '" />';
?>

<h1> Hello <?php echo $userInfo['displayName'] ?> </h1>
<a href="./Profile/createPost.php">
    <button>Create a post</button>
</a>
<a href="./Profile/myProfile.php">
    <button>Your profile</button>
</a>
<a href="Auth/login.php">
    <button>Logout</button>
</a>
<a href="./Friends/FindFriends.php">
    <button>Find Friends</button>
</a>

<br>
<br>
<br>

<script>
    function changeFeedType(type){
        if(type){
            // public
            document.cookie = `postType=1;`
            console.log('Changed to public')
            location.reload()
        }else{
            document.cookie = `postType=0;`
            console.log('Changed to friends')
            location.reload()
            // friends
        }
    }

</script>


<div id="postFilter">
    <button onclick="changeFeedType(true)">Public</button>
    <button onclick="changeFeedType(false)">Friends</button>
</div>


<div id="posts">
    <?php
    $post_Type = $_COOKIE['postType'];
    if($post_Type == 1){
        echo "Showing public posts";
    }else{
        echo "Showing friends posts";
    }
    $Posts_Query = "SELECT * FROM posts where post_type=".$post_Type;
    $Posts_Result = mysqli_query($conn, $Posts_Query);
    while ($Posts = mysqli_fetch_assoc($Posts_Result)) {
        $uploaderData = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT * from userAccount where id=' . $Posts['uploader']));
        echo "<div class='uploder'> <div class='uploaderImage'> <img src='data: " . $uploaderData['profilePicDir'] . ";base64," . base64_encode($uploaderData['profilePic']) . " '> </div>  <div class='uploaderName'> " . $uploaderData['displayName'] . " </div></div>";
        echo "<div class='caption'>" . $Posts['caption'] . "</div> <div class='description'> " . $Posts['description'] . "</div>";
        echo "<div class='location'>" . $Posts['location'] . "</div>";
        echo '<img class="image" src="data:' . $Posts['imageDir'] . ';base64,' . base64_encode($Posts['image']) . '" >';
        echo '<br>';
        echo '<br>';
    }
    ?>
</div>

