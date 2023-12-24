<head>
    <link rel="stylesheet" href="../css/myProfile.css">
</head>

<?php
session_start();
if(!$_SESSION['logged']){
    header("Location: ../Auth/login.php");
}

require '../config.php';
$conn = mysqli_connect(db_host, db_user, db_pass, db_name);

$userInfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM useraccount WHERE id=".$_SESSION['id']));

echo '
<a href="../index.php"> <button>Go back</button></a>
<br>

<div id="userName">
<img class="pfpImage" src="data:'.$userInfo['profilePicDir'].';base64,'.base64_encode($userInfo['profilePic']).'" />
 '.$userInfo['displayName'].' 
</div>

<div id="bio">'.$userInfo['bio'].'</div>
<br>

';

$followerCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM FRIENDS WHERE FOLLOWED=".$_SESSION['id']));
$followingCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM FRIENDS WHERE FOLLOWER=".$_SESSION['id']));
?>


<a href="./follower_Following_list.php?type=follower"><button><?php echo $followerCount ?> Followers</button></a>
<a href="./follower_Following_list.php?type=followed"><button> <?php echo $followingCount ?> Following</button></a>
<br>
<a href="createPost.php"> <button>Create a post</button></a>
<br><br>
<h2>My Posts</h2>

<div id="posts">
<?php
$myPostsQuery = "SELECT * FROM posts WHERE uploader=".$_SESSION['id'];
$myPostsResult = mysqli_query($conn, $myPostsQuery);
while($myPosts = mysqli_fetch_assoc($myPostsResult)){
    $type = $myPosts['post_type'] == 1 ? "Only Followers" : "Public";
    echo "<div class='eachPost'>";
    echo $myPosts['caption'] ."<br>";
    echo $myPosts['description'] ."<br>";
    echo "<img class='postImage' src='data: ".$myPosts['imageDir'].";base64,".base64_encode($myPosts['image'])." '> <br> ";
    echo $type ."<br>";
    echo "<a href='changeVisibility.php?id=".$myPosts['postId']."&curr=". $myPosts['post_type']."'><button>Change to ".($myPosts['post_type'] == 1 ? 'Public' : 'Only Followers') ."</button></a>";
    echo "<a href='removePost.php?id=".$myPosts['postId']."'><button>Remove</button></a>";
    echo "</div>";
}
?>
</div>
