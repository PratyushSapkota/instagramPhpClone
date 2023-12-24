<head>
    <link rel="stylesheet" href="css/front.css">
    <script>
        document.cookie = `postType=1;`

        function changeFeedType(type) {
            if (type) {
                // public
                document.cookie = `postType=1;`
                console.log('Changed to public')
                location.reload()
            } else {
                document.cookie = `postType=0;`
                console.log('Changed to friends')
                location.reload()
                // friends
            }
        }

    </script>
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


<div id="leftNav">
    <h2>Instagram Clone</h2>
    <br>
    <br>
    <a href="./Profile/createPost.php">
        <button>Create a post</button>
    </a>
    <br>
    <br>
    <br>
    <a href="./Profile/myProfile.php">
        <button>Your profile</button>
    </a>
    <br>
    <br>
    <br>
    </a><a href="Followers/requests.php">
        <button>Follow Requests</button>
    </a>
    <br>
    <br>
    <br>
    <a href="Auth/login.php">
        <button>Logout</button>
    </a>

</div>


<div id="feed">
    <div id="postFilter">
        <button class="filterPostsButton" onclick="changeFeedType(true)">Public</button>
        <button class="filterPostsButton" onclick="changeFeedType(false)">Followed</button>
    </div>

    <div id="posts">
        <?php
        $post_Type = $_COOKIE['postType'];
        if ($post_Type == 1) {
            echo "Showing public posts";
        } else {
            echo "Showing friends posts";
        }
        $Posts_Query = "SELECT * FROM posts where post_type=" . $post_Type;
        $Posts_Result = mysqli_query($conn, $Posts_Query);
        while ($Posts = mysqli_fetch_assoc($Posts_Result)) {
            $uploaderData = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT * from userAccount where id=' . $Posts['uploader']));
            echo "<div class='eachPost'>";
            echo "<div class='PostUploder'> <img class='uploaderImage' src='data: " . $uploaderData['profilePicDir'] . ";base64," . base64_encode($uploaderData['profilePic']) . " '> <a href='Profile/otherProfile.php?id=" . $uploaderData['id'] . "'>" . $uploaderData['displayName'] . "</a></div>";
            echo '<div class="PostLocation"> <svg class="locationSvg" style="color: blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18,4.48a8.45,8.45,0,0,0-12,12l5.27,5.28a1,1,0,0,0,1.42,0L18,16.43A8.45,8.45,0,0,0,18,4.48ZM16.57,15,12,19.59,7.43,15a6.46,6.46,0,1,1,9.14,0ZM9,7.41a4.32,4.32,0,0,0,0,6.1,4.31,4.31,0,0,0,7.36-3,4.24,4.24,0,0,0-1.26-3.05A4.3,4.3,0,0,0,9,7.41Zm4.69,4.68a2.33,2.33,0,1,1,.67-1.63A2.33,2.33,0,0,1,13.64,12.09Z" fill="blue"></path></svg> ' . $Posts['location'] . '</div>';
            echo ' <div class="PostImageContainer">   <img class="PostImage" src="data:' . $Posts['imageDir'] . ';base64,' . base64_encode($Posts['image']) . '" > </div>';
            echo "<div class='likesAndCaption'>";
            echo "<p>Likes</p>";
            echo "<div class='PostCaption'>" . $Posts['caption'] . "</div> <div class='description'><i> " . $Posts['description'] . " </i></div>";
            echo "</div>";
            echo "</div>";
            echo '<br>';
            echo '<br>';
        }
        ?>
    </div>

</div>

<div id="rightNav">
    <h3>Discover People</h3>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <input type="text" name="displayName" placeholder="Discover people">
        <input type="submit" value="Search">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $displayName = $_POST['displayName'];
        $displayName = htmlspecialchars(trim($displayName));
        $searchQuery = "SELECT * FROM useraccount where displayName='" . $displayName . "'";
    } else {
        $searchQuery = "Select * from useraccount";
    }

    $searchResult = mysqli_query($conn, $searchQuery);
    while ($result = mysqli_fetch_assoc($searchResult)) {
        if ($result['id'] != $_SESSION['id']) {
            // do not show yourself
            echo "<img src='data: " . $result['profilePicDir'] . ";base64," . base64_encode($result['profilePic']) . "'> ";
            echo $result['displayName'] . "<br>";
            echo $result['bio'] . "<br>";
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * from friends where follower=".$_SESSION['id']." and followed=".$result['id'])) > 0) {
                echo "Following <br><br>";
            } else if(mysqli_num_rows(mysqli_query($conn, "SELECT * from pending where follower=".$_SESSION['id']." and followed=".$result['id'])) > 0) {
                echo "Request Sent <br><br> ";
            }else{
                echo "<a href='./Followers/sendRequest.php?id=" . $result['id'] . "'><button>Request</button></a> <br><br>";
            }
        }
    }
    ?>


</div>





