<head>
    <link rel="stylesheet" href="css/front.css">
</head>

<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: ./Auth/login.php");
}

require './config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$userInfo = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT * FROM useraccount where id=' . $_SESSION['id']));

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
<a href="Followers/FindPeople.php">
    <button>Discover People</button>
</a><a href="Followers/requests.php">
    <button>Follow Requests</button>
</a>

<br>
<br>
<br>

<script>
    document.cookie = `postType=1;`
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
    <button onclick="changeFeedType(false)">Followed</button>
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
        echo "<div class='PostUploder'> <img class='uploaderImage' src='data: " . $uploaderData['profilePicDir'] . ";base64," . base64_encode($uploaderData['profilePic']) . " '> <a href='Profile/otherProfile.php?id=".$uploaderData['id']."'>" . $uploaderData['displayName'] . "</a></div>";
        echo "<div class='PostCaption'>" . $Posts['caption'] . "</div> <div class='description'><i> " . $Posts['description'] ." </i></div>";
        echo '<div class="PostLocation"> <svg class="locationSvg" style="color: blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18,4.48a8.45,8.45,0,0,0-12,12l5.27,5.28a1,1,0,0,0,1.42,0L18,16.43A8.45,8.45,0,0,0,18,4.48ZM16.57,15,12,19.59,7.43,15a6.46,6.46,0,1,1,9.14,0ZM9,7.41a4.32,4.32,0,0,0,0,6.1,4.31,4.31,0,0,0,7.36-3,4.24,4.24,0,0,0-1.26-3.05A4.3,4.3,0,0,0,9,7.41Zm4.69,4.68a2.33,2.33,0,1,1,.67-1.63A2.33,2.33,0,0,1,13.64,12.09Z" fill="blue"></path></svg> ' . $Posts['location'] . '</div>';
        echo '<img class="PostImage" src="data:' . $Posts['imageDir'] . ';base64,' . base64_encode($Posts['image']) . '" >';
        echo '<br>';
        echo '<br>';
    }
    ?>
</div>

