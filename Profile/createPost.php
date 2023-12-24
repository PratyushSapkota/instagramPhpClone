<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Adjust the maximum width as needed */
        }

        input, select {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }

        input[type="file"] {
            cursor: pointer;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        #getLocationButton{
            width: 300px;
        }

        #homeButton{
            left = 50px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 400px; /* Adjust the maximum width as needed */
        }
    </style>
</head>



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

<form action="./addPost.php" method="post" enctype="multipart/form-data">
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

<button id="getLocationButton" onclick="getLocation()">Get location</button>
<br>
<a href="../index.php"><button id="homeButton">Home</button></a>
