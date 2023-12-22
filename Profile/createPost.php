<?php
session_start();
if (!$_SESSION['logged']) {
    header("Location: ../Auth/login.php");
}
?>

<h3>Create a post</h3>
<script>
    const apiKey = '791dfa78f8fb4072a35abd6da76124f9'


    function getLocation() {
        let lat, long
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                lat = position.coords.latitude
                long = position.coords.longitude
                const apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${long}&key=${apiKey}`;
                fetch(apiUrl).then(res => res.json()).then(data => {
                    const locationData = data.results[0].formatted
                    document.getElementById('location').value = locationData
                }).catch(error => console.log(error))
            });
        } else {
            console.log('not able to get location')
        }

    }

</script>

<form action="addPost.php" method="post" enctype="multipart/form-data">
    <input type="text" placeholder="Enter a caption" name="caption">
    <input type="text" placeholder="Enter post description" name="description">
    <select name="type">
        <option value="0">Only Friends</option>
        <option value="1">Public</option>
    </select>
    <div>
        <input type="text" placeholder="Enter location" name="location" id="location">
    </div>

    <input type="file" value="Select an image" name="image">
    <input type="submit" value="POST">
</form>

<button onclick="getLocation()">Get location</button>
